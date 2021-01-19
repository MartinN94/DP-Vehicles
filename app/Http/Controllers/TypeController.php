<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TypeController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Type::paginate(5);

        return view('admin.model.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.model.create');
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
            'name' => 'required|min:2',]);
            
            Type::create([
                'name' => $request->name,
            ]);
    
            return redirect()->route('model.index')->with('message', 'Model is created!');

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
        $model = Type::find($id);

        return view('admin.model.edit', compact('model'));
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
        $vehicle = Vehicle::where(['type_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('model.index')->withErrors('Vehicle model is in use and can not be edited!');
        }

        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        
        $model = Type::find($id);
        $model->name = $request->name;
        $model->save();

        return redirect()->route('model.index')->with('message', 'Model is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where(['type_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle model is in use and can not be deleted!');
        }

        $model = Type::find($id);
        $model->delete();

        return redirect()->route('model.index')->with('message', 'Model is deleted!');

    }
}
