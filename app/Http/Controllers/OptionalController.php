<?php

namespace App\Http\Controllers;

use App\Models\Optional;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OptionalController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $optionals = Optional::paginate(5);

        return view('admin.optional.index', compact('optionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.optional.create');
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
            
            Optional::create([
                'name' => $request->name,
            ]);
    
            return redirect()->route('optional.index')->with('message', 'Optional feature is created!');

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
        $optional = Optional::find($id);

        return view('admin.optional.edit', compact('optional'));
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
        $vehicle = Vehicle::whereHas('optionals', function ($query) use($id) {
            $query->where('id', $id);
        }); 

        if ($vehicle->exists()) {
            return redirect()->route('optional.index')->withErrors('Vehicle feature is in use and can not be edited!');
        }

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $optional = Optional::find($id);
        $optional->name = $request->name;
        $optional->save();

        return redirect()->route('optional.index')->with('message', 'Feature is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::whereHas('optionals', function ($query) use($id) {
            $query->where('id', $id);
        }); 
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle tag is in use and can not be deleted!');
        }

        $optional = Optional::find($id);
        $optional->delete();

        return redirect()->route('optional.index')->with('message', 'Optional feature is deleted!');

    }
}
