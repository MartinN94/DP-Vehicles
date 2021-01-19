<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class StoreController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::paginate(5);

        return view('admin.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.store.create');
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
            'location' => 'required|min:2',
        ])) {
            
            Store::create([
                'name' => $request->name,
                'location' => $request->location,
            ]);
    
            return redirect()->route('store.index')->with('message', 'Store is created!');

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
        $store = Store::find($id);

        return view('admin.store.edit', compact('store'));
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
        $vehicle = Vehicle::where(['store_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('store.index')->withErrors('Vehicle store is in use and can not be edited!');
        }

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required|min:2',
        ]);
        
        $store = Store::find($id);
        $store->name = $request->name;
        $store->location = $request->location;
        $store->save();

        return redirect()->route('store.index')->with('message', 'Store is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where(['store_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle store is in use and can not be deleted!');
        }

        $store = Store::find($id);
        $store->delete();

        return redirect()->route('store.index')->with('message', 'Store is deleted!');

    }
}
