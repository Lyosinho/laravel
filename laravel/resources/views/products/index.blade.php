@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6">
	<h1 class="text-2xl font-bold mb-4">Produtos</h1>

	@if(session('success'))
		<div class="bg-green-100 text-green-800 p-2 mb-4">{{ session('success') }}</div>
	@endif

	@if ($errors->any())
		<div class="bg-red-100 text-red-800 p-2 mb-4">
			<ul class="list-disc ml-6">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('products.store') }}" class="space-y-3 mb-8">
		@csrf
		<div>
			<label class="block mb-1">Nome</label>
			<input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2" required>
		</div>
		<div>
			<label class="block mb-1">Preço</label>
			<input type="number" name="price" step="0.01" value="{{ old('price') }}" class="w-full border p-2" required>
		</div>
		<div>
			<label class="block mb-1">Categoria (opcional)</label>
			<select name="category_id" class="w-full border p-2">
				<option value="">Selecione...</option>
				@foreach($categories as $category)
					<option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="bg-blue-600 text-white px-4 py-2">Salvar</button>
	</form>

	<h2 class="text-xl font-semibold mb-2">Lista de Produtos</h2>
	<ul class="space-y-2">
		@forelse($products as $product)
			<li class="border p-2 flex justify-between">
				<span>{{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}
					@if($product->category)
						<small class="text-gray-600"> ({{ $product->category->name }})</small>
					@endif
				</span>
			</li>
		@empty
			<li class="text-gray-600">Nenhum produto cadastrado.</li>
		@endforelse
	</ul>
</div>
@endsection

