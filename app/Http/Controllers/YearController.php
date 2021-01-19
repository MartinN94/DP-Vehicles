<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::paginate(5);

        return view('admin.year.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.year.create');
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
            'year' => 'required|digits:4',
        ])) {
            
            Year::create([
                'year' => $request->year,
            ]);
    
            return redirect()->route('year.index')->with('message', 'Year is created!');

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
        $year = Year::find($id);

        return view('admin.year.edit', compact('year'));
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
        $vehicle = Vehicle::where(['year_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('year.index')->withErrors('Year is in use and can not be edited!');
        }

        $this->validate($request, [
            'year' => 'required|digits:4',
        ]);
        
        $year = Year::find($id);
        $year->year = $request->year;
        $year->save();

        return redirect()->route('year.index')->with('message', 'Year is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $vehicle = Vehicle::where(['year_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Year is in use and can not be deleted!');
        }
        $year = Year::find($id);
        $year->delete();

        return redirect()->route('year.index')->with('message', 'Year is deleted!');

    }
}
