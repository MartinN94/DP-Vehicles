<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Make;
use App\Models\Sku;
use App\Models\Store;
use App\Models\Type;
use App\Models\Vehicle;
use App\Models\Year;
use Illuminate\Http\Request;

class IndexConttroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where(['available' => '1'])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);

        return view('site.index', compact('vehicles'));
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

        return view('site.show', compact('vehicle'));
    }

    // FILTER FUNCTION NOT FINISHED
    public function filter(Request $request){
       
        $this->validate($request, [
            'keyword' => "required",
            'group' => 'required',
            'subgroup' => 'required'
        ]);


        if ($request->group == 'details') {
            if ($request->subgroup == 'price') {
                $vehicles = Vehicle::where(['price' => $request->keyword])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
            }else {
                return redirect()->back();
            }
        }
        if ($request->group == 'details') {
            if ($request->subgroup == 'description') {
                $vehicles = Vehicle::where('description', 'LIKE', '%'.$request->keyword.'%')->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
            }else {
                return redirect()->back();
            }
        }
        if ($request->group == 'meta') {
            if ($request->subgroup == 'year') {
                $year = Year::where(['year' => $request->keyword])->get();
                if ($year->isNotEmpty()) {
                    $vehicles = Vehicle::where(['year_id' => $year[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        if ($request->group == 'meta') {
            if ($request->subgroup == 'make') {
                $make = Make::where(['name' => $request->keyword])->get();
                if ($make->isNotEmpty()) {
                    $vehicles = Vehicle::where(['make_id' => $make[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }


            }
        }
        
        if ($request->group == 'meta') {
            if ($request->subgroup == 'model') {
                $model = Type::where(['name' => $request->keyword])->get();
                if ($model->isNotEmpty()) {
                    $vehicles = Vehicle::where(['type_id' => $model[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        if ($request->group == 'meta') {
            if ($request->subgroup == 'sku') {
                $sku = Sku::where(['name' => $request->keyword])->get();
                if ($sku->isNotEmpty()) {
                    $vehicles = Vehicle::where(['sku_id' => $sku[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        if ($request->group == 'store') {
            if ($request->subgroup == 'name') {
                $storeName = Store::where(['name' => $request->keyword])->get();
                if ($storeName->isNotEmpty()) {
                    $vehicles = Vehicle::where(['store_id' => $storeName[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        if ($request->group == 'store') {
            if ($request->subgroup == 'location') {
                $storeName = Store::where(['location' => $request->keyword])->get();
                if ($storeName->isNotEmpty()) {
                    $vehicles = Vehicle::where(['store_id' => $storeName[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        if ($request->group == 'category') {
            if ($request->subgroup == 'name') {
                $category = Category::where(['name' => $request->keyword])->get();
                if ($category->isNotEmpty()) {
                    $vehicles = Vehicle::where(['category_id' => $category[0]->id])->with('year', 'maker', 'model', 'sku', 'store', 'tags', 'features')->paginate(5);
                }else {
                    return redirect()->back();
                }

            }
        }

        
        return view('site.index', compact('vehicles'));
        
    }
}