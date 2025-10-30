<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::latest()->get();
		return view('categories.index', compact('categories'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
		]);

		Category::create($validated);

		return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso!');
	}
}
