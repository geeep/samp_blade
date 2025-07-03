<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(){
        $products = Product::all();
        return view('products.index', [
            'products' => $products
        ]);

    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create the uploads directory if it doesn't exist
       $uploadPath = public_path('uploads');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        // Create a new product instance
        $newProduct = new Product();
        $newProduct->name = $data['name'];
        $newProduct->description = $data['description'];
        $newProduct->price = $data['price'];
        $newProduct->stock = $data['stock'];
        $newProduct->category = $data['category'];
        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $newProduct->image = 'uploads/' . $imageName; // Store the relative path
        }
        // Save the product to the database
        try {
            $newProduct->save();
        } catch (\Exception $e) {
            // Handle any errors that occur during the save operation
            return redirect()->back()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()]);
        // Redirect to the product index page with a success message
        }
        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product){

        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(Product $product, Request $request){

        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update the product instance
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->category = $data['category'];

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $product->image = 'uploads/' . $imageName; // Store the relative path
        }

        // Save the updated product to the database
        try {
            $product->save();
        } catch (\Exception $e) {
            // Handle any errors that occur during the save operation
            return redirect()->back()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()]);
        }

        // Redirect to the product index page with a success message
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product){

        // Delete the product image if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete the product from the database
        try {
            $product->delete();
        } catch (\Exception $e) {
            // Handle any errors that occur during the delete operation
            return redirect()->back()->withErrors(['error' => 'Failed to delete product: ' . $e->getMessage()]);
        }

        // Redirect to the product index page with a success message
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
