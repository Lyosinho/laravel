@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6">
	<div class="mb-4">
		<a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">← Voltar para Produtos</a>
	</div>

	<div class="flex justify-between items-center mb-4">
		<h1 class="text-2xl font-bold">{{ $product->name }}</h1>
		<div class="flex gap-2">
			<a href="{{ route('products.edit', $product) }}" class="bg-green-600 text-white px-4 py-2 rounded">Editar</a>
			<form method="POST" action="{{ route('products.destroy', $product) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
				@csrf
				@method('DELETE')
				<button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Excluir</button>
			</form>
		</div>
	</div>

	<div class="bg-white border rounded p-4">
		@if($product->image)
			<div class="mb-4">
				<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded">
			</div>
		@endif

		<div class="space-y-2">
			<p><strong>Nome:</strong> {{ $product->name }}</p>
			<p><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
			<p><strong>Categoria:</strong> 
				@if($product->category)
					{{ $product->category->name }}
				@else
					<span class="text-gray-500">Sem categoria</span>
				@endif
			</p>
			<p><strong>Criado em:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
			@if($product->updated_at != $product->created_at)
				<p><strong>Atualizado em:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</p>
			@endif
		</div>
	</div>
</div>
@endsection
