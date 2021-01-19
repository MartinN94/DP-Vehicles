<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(5);

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
            'tag' => 'required|string',
        ])) {
            Tag::create([
                'name' => $request->tag,
            ]);
    
            return redirect()->route('tag.index')->with('message', 'Tag is created!');
        } else {
            return redirect()->back()->with('error', 'Incorrect input!')->withInput();
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
        $tag = Tag::find($id);

        return view('admin.tag.edit', compact('tag'));
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
        $vehicle = Vehicle::whereHas('tags', function ($query) use($id) {
            $query->where('id', $id);
        }); 

        if ($vehicle->exists()) {
            return redirect()->route('tag.index')->withErrors('Vehicle tag is in use and can not be edited!');
        }

        $tag = Tag::find($id);
        $tag->name = $request->tag;
        $tag->save();

        return redirect()->route('tag.index')->with('message', 'Tag is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $vehicle = Vehicle::whereHas('tags', function ($query) use($id) {
            $query->where('id', $id);
        }); 

        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle tag is in use and can not be deleted!');
        }

        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tag.index')->with('message', 'Tag is deleted!');

    }
}
