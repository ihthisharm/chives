<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Create a new instance with auth as middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate
        $this->validate($request, [
            'image' => 'image|nullable|max:1999'
        ]);

        $slug = Str::slug($request->name, '-');

        //Handle File
        if ($request->hasFile('image')) {
            //File Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Self Explanatory
            $fileNameToStore = $slug . '.' . $extension;
            //Do save
            $request->file('image')->storeAs('public/img/categories', $fileNameToStore);
        } else {
            $fileNameToStore = 'https://robohash.org/' . $slug . '.png?bgset=bg1';
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'image' => '/storage/img/categories/' . $fileNameToStore
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $items = Category::find(1)->items;
        return view('categories.show')->with(['category' => $category, 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validate
        $this->validate($request, [
            'image' => 'image|nullable|max:1999'
        ]);

        $slug = Str::slug($request->name, '-');

        //Handle File
        if ($request->hasFile('image')) {
            //File Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Self Explanatory
            $fileNameToStore = $slug . '.' . $extension;
            //Do save
            $request->file('image')->storeAs('public/img/categories', $fileNameToStore);
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $category->image = '/storage/img/categories/' . $fileNameToStore;
        } else {
            $category->image = $category->image;
        }

        $category->save();
        return redirect('/categories/' . $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categories');
    }
}
