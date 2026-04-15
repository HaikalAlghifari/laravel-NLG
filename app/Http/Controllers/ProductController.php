<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        // filter name
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // filter stock (min)
        if ($request->stock_min) {
            $query->where('stock', '>=', $request->stock_min);
        }
        // filter price (min)
        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        $products = $query->latest()->paginate(5)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product Successfully Created');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product Successfully Updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Successfully Deleted');
    }

    // Sync API
    public function sync()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        foreach ($response->json() as $item) {
            Product::updateOrCreate(
                ['name' => $item['title']],
                [
                    'price' => $item['price'],
                    'stock' => rand(1, 100),
                    'description' => $item['description'],
                ],
            );
        }
        return redirect()->route('products.index')->with('success', 'Sync Successfully!');
    }
}
