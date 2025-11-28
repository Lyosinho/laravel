@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl py-6">
	<div class="flex justify-between items-center mb-4">
		<h1 class="text-2xl font-bold">Produtos</h1>
		<a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Novo Produto</a>
	</div>

	@if(session('success'))
		<div class="bg-green-100 text-green-800 p-2 mb-4">{{ session('success') }}</div>
	@endif

	@if(session('error'))
		<div class="bg-red-100 text-red-800 p-2 mb-4">{{ session('error') }}</div>
	@endif

	@if($lastCategory)
		<div class="bg-blue-100 text-blue-800 p-2 mb-4">
			Última categoria acessada: {{ $categories->find($lastCategory)->name ?? 'Categoria removida' }}
		</div>
	@endif

	@if($products->count() > 0)
		<div class="overflow-x-auto">
			<table class="w-full border-collapse border border-gray-300">
				<thead>
					<tr class="bg-gray-100">
						<th class="border border-gray-300 p-2 text-left">Imagem</th>
						<th class="border border-gray-300 p-2 text-left">Nome</th>
						<th class="border border-gray-300 p-2 text-left">Preço</th>
						<th class="border border-gray-300 p-2 text-left">Categoria</th>
						<th class="border border-gray-300 p-2 text-left">Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
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
								@if($product->category)
									{{ $product->category->name }}
								@else
									<span class="text-gray-500">Sem categoria</span>
								@endif
							</td>
							<td class="border border-gray-300 p-2">
								<div class="flex gap-2">
									<a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">Ver</a>
									<a href="{{ route('products.edit', $product) }}" class="text-green-600 hover:underline">Editar</a>
									<form method="POST" action="{{ route('products.destroy', $product) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="text-red-600 hover:underline">Excluir</button>
									</form>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="text-center py-8">
			<p class="text-gray-600 mb-4">Nenhum produto cadastrado.</p>
			<a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Criar Primeiro Produto</a>
		</div>
	@endif
</div>
@endsection

