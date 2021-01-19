<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category' => 'required|string',
        ])) {
            Category::create([
                'name' => $request->category,
            ]);
    
            return redirect()->route('category.index')->with('message', 'Category is created!');
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
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
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
        $vehicle = Vehicle::where(['category_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->route('category.index')->withErrors('Vehicle category is in use and can not be edited!');
        }

        $category = Category::find($id);
        $category->name = $request->category;
        $category->save();

        return redirect()->route('category.index')->with('message', 'Category is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where(['category_id' => $id]);
        if ($vehicle->exists()) {
            return redirect()->back()->withErrors('Vehicle category is in use and can not be deleted!');
        }

        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('message', 'Category is deleted!');

    }
}
