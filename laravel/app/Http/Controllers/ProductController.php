<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function index()
	{
		$lastCategory = request()->cookie('last_category');
		$products = Product::with('category')->latest()->get();
		$categories = Category::orderBy('name')->get();
		return view('products.index', compact('products', 'categories', 'lastCategory'));
	}

	public function create()
	{
		$categories = Category::orderBy('name')->get();
		return view('products.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'price' => ['required', 'numeric', 'min:0'],
			'category_id' => ['nullable', 'exists:categories,id'],
			'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
		]);

		if ($request->hasFile('image')) {
			$validated['image'] = $request->file('image')->store('products', 'public');
		}

		Product::create($validated);

		$response = redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
		
		if ($validated['category_id']) {
			$response->cookie('last_category', $validated['category_id'], 60 * 24 * 30);
		}

		return $response;
	}

	public function show(Product $product)
	{
		return view('products.show', compact('product'));
	}

	public function edit(Product $product)
	{
		$categories = Category::orderBy('name')->get();
		return view('products.edit', compact('product', 'categories'));
	}

	public function update(Request $request, Product $product)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'price' => ['required', 'numeric', 'min:0'],
			'category_id' => ['nullable', 'exists:categories,id'],
			'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
		]);

		if ($request->hasFile('image')) {
			if ($product->image) {
				\Storage::disk('public')->delete($product->image);
			}
			$validated['image'] = $request->file('image')->store('products', 'public');
		}

		$product->update($validated);

		return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
	}

	public function destroy(Product $product)
	{
		if ($product->image) {
			\Storage::disk('public')->delete($product->image);
		}

		$product->delete();

		return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
	}
}
