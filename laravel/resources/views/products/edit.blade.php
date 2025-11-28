@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6">
	<div class="mb-4">
		<a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">← Voltar para Produtos</a>
	</div>

	<h1 class="text-2xl font-bold mb-4">Editar Produto: {{ $product->name }}</h1>

	@if ($errors->any())
		<div class="bg-red-100 text-red-800 p-2 mb-4">
			<ul class="list-disc ml-6">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-3">
		@csrf
		@method('PUT')
		<div>
			<label class="block mb-1">Nome</label>
			<input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2" required>
		</div>
		<div>
			<label class="block mb-1">Preço</label>
			<input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" class="w-full border p-2" required>
		</div>
		<div>
			<label class="block mb-1">Categoria</label>
			<select name="category_id" class="w-full border p-2">
				<option value="">Selecione...</option>
				@foreach($categories as $category)
					<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)==$category->id)>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label class="block mb-1">Imagem (PNG ou JPG)</label>
			@if($product->image)
				<div class="mb-2">
					<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
					<p class="text-sm text-gray-600">Imagem atual</p>
				</div>
			@endif
			<input type="file" name="image" class="w-full border p-2" accept=".png,.jpg,.jpeg">
			<small class="text-gray-600">Formatos aceitos: PNG, JPG. Deixe em branco para manter a imagem atual.</small>
		</div>
		<div class="flex gap-2">
			<button type="submit" class="bg-blue-600 text-white px-4 py-2">Atualizar</button>
			<a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2">Cancelar</a>
		</div>
	</form>
</div>
@endsection
