<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return Inertia::render('products/Index', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        return Inertia::render('ProductPage', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'collection' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product added!');
    }

    public function update(Request $request, Product $product)
    {
        try {
            // Log the incoming request data for debugging
            Log::info('Product update request received', [
                'product_id' => $product->id,
                'request_data' => $request->all(),
                'has_file' => $request->hasFile('image')
            ]);

            $validationRules = [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'collection' => 'nullable|string|max:255',
            ];

            // Only validate image if a new file is uploaded
            if ($request->hasFile('image')) {
                $validationRules['image'] = 'nullable|image|mimes:jpg,jpeg,png,webp';
            }

            $data = $request->validate($validationRules);

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($data);

            Log::info('Product updated successfully', ['product_id' => $product->id]);

            return redirect()->back()->with('success', 'Product updated successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error during product update', [
                'errors' => $e->errors(),
                'product_id' => $product->id
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage(), [
                'product_id' => $product->id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }
    
    public function edit(Product $product)
    {
        return Inertia::render('products/Edit', [
            'product' => $product
        ]);
    }

    // Show create form for admin
    public function create()
    {
        return Inertia::render('admin/CreateProduct');
    }


    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted!');
    }
}
