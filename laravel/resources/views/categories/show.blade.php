@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl py-6">
	<div class="mb-4">
		<a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">← Voltar para Categorias</a>
	</div>

	<div class="flex justify-between items-center mb-4">
		<h1 class="text-2xl font-bold">{{ $category->name }}</h1>
		<div class="flex gap-2">
			<a href="{{ route('categories.edit', $category) }}" class="bg-green-600 text-white px-4 py-2 rounded">Editar</a>
			@if($category->products->count() == 0)
				<form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
					@csrf
					@method('DELETE')
					<button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Excluir</button>
				</form>
			@endif
		</div>
	</div>

	<div class="bg-white border rounded p-4 mb-6">
		<div class="space-y-2">
			<p><strong>Nome:</strong> {{ $category->name }}</p>
			<p><strong>Total de produtos:</strong> {{ $category->products->count() }}</p>
			<p><strong>Criado em:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>
			@if($category->updated_at != $category->created_at)
				<p><strong>Atualizado em:</strong> {{ $category->updated_at->format('d/m/Y H:i') }}</p>
			@endif
		</div>
	</div>

	@if($category->products->count() > 0)
		<h2 class="text-xl font-bold mb-4">Produtos desta Categoria</h2>
		<div class="overflow-x-auto">
			<table class="w-full border-collapse border border-gray-300">
				<thead>
					<tr class="bg-gray-100">
						<th class="border border-gray-300 p-2 text-left">Imagem</th>
						<th class="border border-gray-300 p-2 text-left">Nome</th>
						<th class="border border-gray-300 p-2 text-left">Preço</th>
						<th class="border border-gray-300 p-2 text-left">Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($category->products as $product)
						<tr>
							<td class="border border-gray-300 p-2">
								@if($product->image)
									<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
								@else
									<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs">Sem imagem</div>
								@endif
							</td>
							<td class="border border-gray-300 p-2">{{ $product->name }}</td>
							<td class="border border-gray-300 p-2">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
							<td class="border border-gray-300 p-2">
								<div class="flex gap-2">
									<a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">Ver</a>
									<a href="{{ route('products.edit', $product) }}" class="text-green-600 hover:underline">Editar</a>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="text-center py-8 bg-gray-100 rounded">
			<p class="text-gray-600 mb-4">Nenhum produto nesta categoria.</p>
			<a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Adicionar Produto</a>
		</div>
	@endif
</div>
@endsection
