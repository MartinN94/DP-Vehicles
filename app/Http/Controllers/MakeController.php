<?php

namespace App\Http\Controllers;

use App\Models\Make;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makers = Make::paginate(5);

        return view('admin.make.index', compact('makers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.make.create');
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
            'name' => 'required|min:2',
        ])) {
            
            Make::create([
                'name' => $request->name,
            ]);
    
            return redirect()->route('make.index')->with('message', 'Maker is created!');

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
        $make = Make::find($id);

        return view('admin.make.edit', compact('make'));
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
        $vehicle = Vehicle::where(['make_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('make.index')->withErrors('Vehicle maker is in use and can not be edited!');
        }

        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        
        $make = Make::find($id);
        $make->name = $request->name;
        $make->save();

        return redirect()->route('make.index')->with('message', 'Maker is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where(['make_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle maker is in use and can not be deleted!');
        }

        $make = Make::find($id);
        $make->delete();

        return redirect()->route('make.index')->with('message', 'Maker is deleted!');

    }
}
