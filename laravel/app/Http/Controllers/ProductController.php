<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function index()
	{
		$products = Product::with('category')->latest()->get();
		$categories = Category::orderBy('name')->get();
		return view('products.index', compact('products', 'categories'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'price' => ['required', 'numeric', 'min:0'],
			'category_id' => ['nullable', 'exists:categories,id'],
		]);

		Product::create($validated);

		return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
	}
}
