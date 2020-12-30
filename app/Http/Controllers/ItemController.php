<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ItemController extends Controller
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
        $items = Item::orderBy('name')->with(['category:id,name,slug'])->paginate();
        return view('items.index')->with(['items' => $items, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $request->file('image')->storeAs('public/img/items', $fileNameToStore);
        } else {
            $fileNameToStore = 'https://robohash.org/' . $slug . '.png?bgset=bg1';
        }

        Item::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'image' => '/storage/img/items/' . $fileNameToStore,
            'category_id' => $request->category_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $categories = Category::all();
        return view('items.show')->with(['item' => $item, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
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
            $request->file('image')->storeAs('public/img/items', $fileNameToStore);
        }

        $item->name = $request->name;
        $item->description = $request->description;
        $item->slug = $slug;
        $item->price = $request->price;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $item->image = '/storage/img/items/' . $fileNameToStore;
        } else {
            $item->image = $item->image;
        }

        $item->save();
        return redirect('/items/' . $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/items');
    }
}
