<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SkuController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skus = Sku::paginate(5);

        return view('admin.sku.index', compact('skus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($this->validate($request, [
            'name' => 'required',
        ])) {
            
            Sku::create([
                'name' => $request->name,
            ]);
    
            return redirect()->route('sku.index')->with('message', 'SKU is created!');

        } else {

            return redirect()->back()->withInput()->with('error', 'invalid inputs');
            
        }
        



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sku = Sku::find($id);

        return view('admin.sku.edit', compact('sku'));
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
        $vehicle = Vehicle::where(['sku_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('sku.index')->withErrors('Vehicle SKU is in use and can not be edited!');
        }

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $sku = Sku::find($id);
        $sku->name = $request->name;
        $sku->save();

        return redirect()->route('sku.index')->with('message', 'SKU is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where(['sku_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle SKU is in use and can not be deleted!');
        }

        $sku = Sku::find($id);
        $sku->delete();

        return redirect()->route('sku.index')->with('message', 'SKU is deleted!');

    }
}
