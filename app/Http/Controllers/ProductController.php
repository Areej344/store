<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  // ProductController.php


  public function store(Request $request)
  {
      // Validate the request
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'price' => 'required|numeric',
        'points' => 'required|numeric',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);
  
      // Handle file upload if there is an image
      $imagePath = null;
      if ($request->hasFile('image')) {
          $imagePath = $request->file('image')->store('public/products');
      }
  
      // Create the product
      $product = new Product();
      $product->name = $validatedData['name'];
      $product->description = $validatedData['description'];
      $product->price = $validatedData['price'];
      $product->points = $validatedData['points'];
      $product->quantity = $validatedData['quantity'];
      $product->image = $imagePath;
      $product->category_id = $validatedData['category_id'];
      $product->save();
  
      // Redirect back or to another page with a success message
      return redirect()->route('products.index')->with('success', 'Product created successfully.');
  }
  


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $product = Product::with('category')->findOrFail($id); // Get product with category
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Get all categories for the dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'points' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Find the product
        $product = Product::findOrFail($id);
    
        // Handle file upload if there is an image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete($product->image);
            }
    
            // Store the new image
            $validatedData['image'] = $request->file('image')->store('public/products');
        }
    
        // Update the product with validated data
        $product->update($validatedData);
    
        // Redirect back or to another page with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Search for products that match the query
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(10);

        // Return the search results view
        return view('products.search', compact('products', 'query'));
    }
}
