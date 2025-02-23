<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('products')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products = $category->products()->paginate(6); // Change the number to your preferred items per page

        return view('categories.show', compact('category', 'products'));
    }





     //     public function index()
//     {
//         $categories = Category::all(); 
//         return view('categories.index', compact('categories'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
    public function create()
    {
        // Retrieve all categories from the database
        $categories = Category::all();
    
        // Pass the categories to the view
        return view('categories.create', compact('categories'));
    }
    

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:categories,name',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Store in public disk
    }

    Category::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect()->route('categories.index')->with('success', 'Category created successfully');
}


//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\Category  $category
//      * @return \Illuminate\Http\Response
//      */
    // public function show($id)
    // {
    //     $category = Category::with('products')->findOrFail($id);
    //     $products = $category->products()->paginate(6); // Change the number to your preferred items per page

    //     return view('category.show', compact('category', 'products'));
    // }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Models\Category  $category
//      * @return \Illuminate\Http\Response
//      */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Models\Category  $category
//      * @return \Illuminate\Http\Response
//      */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    
    }
}
