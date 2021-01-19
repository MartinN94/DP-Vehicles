<?php

namespace App\Http\Controllers;

use App\Models\Make;
use App\Models\Optional;
use App\Models\Sku;
use App\Models\Store;
use App\Models\Type;
use App\Models\Vehicle;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public $year;
    public $maker;
    public $model;
    public $sku;
    public $store;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);

        return view('admin.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'currency' => 'required',
            'price_type' => 'required',
            'sold' => 'required',
            'arriving' => 'required',
            'available' => 'required',
            'year' => 'required_without:yearInput',
            'yearInput' => 'required_without:year',
            'maker' => 'required_without:makerInput',
            'makerInput' => 'required_without:maker',
            'model' => 'required_without:modelInput',
            'modelInput' => 'required_without:model',
            'sku' => 'required_without:skuInput',
            'skuInput' => 'required_without:sku',
            'store' => 'required_without:storeInput',
            'storeInput' => 'required_without:store',
            'storeLocationInput' => 'required_without:store',
            'description' => 'required',
            "category" => 'required',
            "feature" => 'required|array|min:1',
            "tag" => 'required|array|min:1'
        ]);
           

            $this->year = $request->year;
            $this->maker = $request->maker;
            $this->model = $request->model;
            $this->sku = $request->sku;
            $this->store = $request->store;

        if ($request->has('yearInput') && !empty($request->yearInput)) {
                $yearFind = Year::where(['year' => $request->yearInput])->get();
            if ($yearFind->isNotEmpty()) {
                foreach ($yearFind->pluck('id') as $key => $id) {
                            $this->year = $id;
                }
            }else {
                $newYear = Year::create([
                    'year'=> $request->yearInput
                ]);
                $this->year = $newYear->id;
            }
        }
        

        if ($request->has('makerInput') && !empty($request->makerInput)) {
            $makerFind = Make::where(['name' => $request->makerInput])->get();
            if ($makerFind->isNotEmpty()) {
                foreach ($makerFind->pluck('id') as $key => $id) {
                        $this->maker = $id;
                }
            }else {
                $newMaker = Make::create([
                    'name'=> $request->makerInput
                ]);
                $this->maker = $newMaker->id;
            }
        }

        if ($request->has('modelInput') && !empty($request->modelInput) ) {
            $modelFind = Type::where(['name' => $request->modelInput])->get();
            if ($modelFind->isNotEmpty()) {
                foreach ($modelFind->pluck('id') as $key => $id) {
                        $this->model = $id;
                }
            }else {
                $newModel = Type::create([
                    'name'=> $request->modelInput
                ]);
                $this->model = $newModel->id;
            }
        }

        if ($request->has('skuInput') && !empty($request->skuInput)) {
            $skuFind = Sku::where(['name' => $request->skuInput])->get();
            if ($skuFind->isNotEmpty()) {
                foreach ($skuFind->pluck('id') as $key => $id) {
                        $this->sku = $id;

                }
            }else {
                $newSku = Sku::create([
                    'name'=> $request->skuInput
                ]);
                $this->sku = $newSku->id;
            }
        }

        if ($request->has('skuInput') && !empty($request->skuInput) && !empty($request->storeInput) && !empty($request->storeLocationInput)) {
            $storeFind = Store::where(['name' => $request->storeInput, 'location' => $request->storeLocationInput])->get();
            if ($storeFind->isNotEmpty()) {
                foreach ($storeFind->pluck('id') as $key => $id) {
                        $this->store = $id;
                }
            }else {

                $newStore = Store::create([
                    'name'=> $request->storeInput,
                    'location' => $request->storeLocationInput
                ]);
                $this->store = $newStore->id;
            }
        }



        $newVehicle = Vehicle::create([
            'user_id' => Auth::user()->id,
            'price' => $request->price,
            'currency' => $request->currency,
            'price_type' => $request->price_type,
            'sold' => $request->sold,
            'arriving' => $request->arriving,
            'available' => $request->available,
            'year_id' => $this->year,
            'make_id' => $this->maker,
            'type_id' => $this->model,
            'sku_id' => $this->sku,
            'store_id' => $this->store,
            'description' => $request->description,
            'category_id' => $request->category,
        ]);

        $vehicle = Vehicle::find($newVehicle->id);
       
        $vehicle->features()->sync($request->feature);
        $vehicle->tags()->sync($request->tag);
        
        $vehicle->saveImages($request);

        return redirect()->route('vehicle.index')->with('message', 'Vehicle is created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        return view('admin.vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        return view('admin.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'price' => 'required',
            'currency' => 'required',
            'price_type' => 'required',
            'sold' => 'required',
            'arriving' => 'required',
            'available' => 'required',
            'year' => 'required_without:yearInput',
            'yearInput' => 'required_without:year',
            'maker' => 'required_without:makerInput',
            'makerInput' => 'required_without:maker',
            'model' => 'required_without:modelInput',
            'modelInput' => 'required_without:model',
            'sku' => 'required_without:skuInput',
            'skuInput' => 'required_without:sku',
            'store' => 'required_without:storeInput, storeLocationInput',
            'storeInput' => 'required_without:store',
            'storeLocationInput' => 'required_without:store',
            'description' => 'required',
            "category" => 'required',
            "feature" => 'required|array|min:1',
            "tag" => 'required|array|min:1'
        ]);


            $this->year = $request->year;
            $this->maker = $request->maker;
            $this->model = $request->model;
            $this->sku = $request->sku;
            $this->store = $request->store;

        if ($request->has('yearInput') && !empty($request->yearInput)) {
                $yearFind = Year::where(['year' => $request->yearInput])->get();
            if ($yearFind->isNotEmpty()) {
                foreach ($yearFind->pluck('id') as $key => $id) {
                            $this->year = $id;
                }
            }else {
                $newYear = Year::create([
                    'year'=> $request->yearInput
                ]);
                $this->year = $newYear->id;
            }
        }
        

        if ($request->has('makerInput') && !empty($request->makerInput)) {
            $makerFind = Make::where(['name' => $request->makerInput])->get();
            if ($makerFind->isNotEmpty()) {
                foreach ($makerFind->pluck('id') as $key => $id) {
                        $this->maker = $id;
                }
            }else {
                $newMaker = Make::create([
                    'name'=> $request->makerInput
                ]);
                $this->maker = $newMaker->id;
            }
        }

        if ($request->has('modelInput') && !empty($request->modelInput) ) {
            $modelFind = Type::where(['name' => $request->modelInput])->get();
            if ($modelFind->isNotEmpty()) {
                foreach ($modelFind->pluck('id') as $key => $id) {
                        $this->model = $id;
                }
            }else {
                $newModel = Type::create([
                    'name'=> $request->modelInput
                ]);
                $this->model = $newModel->id;
            }
        }

        if ($request->has('skuInput') && !empty($request->skuInput)) {
            $skuFind = Sku::where(['name' => $request->skuInput])->get();
            if ($skuFind->isNotEmpty()) {
                foreach ($skuFind->pluck('id') as $key => $id) {
                        $this->sku = $id;

                }
            }else {
                $newSku = Sku::create([
                    'name'=> $request->skuInput
                ]);
                $this->sku = $newSku->id;
            }
        }

        if ($request->has('storeInput')  && $request->has('storeLocationInput') && !empty($request->storeInput) && !empty($request->storeLocationInput)) {
            $storeFind = Store::where(['name' => $request->storeInput, 'location' => $request->storeLocationInput])->get();
            if ($storeFind->isNotEmpty()) {
                foreach ($storeFind->pluck('id') as $key => $id) {
                        $this->store = $id;
                }
            }else {
                $newStore = Store::create([
                    'name'=> $request->storeInput,
                    'location' => $request->storeLocationInput
                ]);
                $this->store = $newStore->id;
            }
        }

        $findVehicle = Vehicle::where(['id'=> $id])
        ->update([
            'price' => $request->price,
            'currency' => $request->currency,
            'price_type' => $request->price_type,
            'sold' => $request->sold,
            'arriving' => $request->arriving,
            'available' => $request->available,
            'year_id' => $this->year,
            'make_id' => $this->maker,
            'type_id' => $this->model,
            'sku_id' => $this->sku,
            'store_id' => $this->store,
            'description' => $request->description,
            'category_id' => $request->category,
        ]);

        $vehicle = Vehicle::find($id);
       
        $vehicle->features()->sync($request->feature);
        $vehicle->tags()->sync($request->tag);
        
        $vehicle->saveImages($request);

        return redirect()->route('vehicle.index')->with('message', 'Vehicle is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();

       return redirect()->back()->with('message', 'Vehicle is deleted');
    }
}
