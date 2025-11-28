@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl py-6">
	<div class="flex justify-between items-center mb-4">
		<h1 class="text-2xl font-bold">Categorias</h1>
		<a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Categoria</a>
	</div>

	@if(session('success'))
		<div class="bg-green-100 text-green-800 p-2 mb-4">{{ session('success') }}</div>
	@endif

	@if(session('error'))
		<div class="bg-red-100 text-red-800 p-2 mb-4">{{ session('error') }}</div>
	@endif

	@if($categories->count() > 0)
		<div class="overflow-x-auto">
			<table class="w-full border-collapse border border-gray-300">
				<thead>
					<tr class="bg-gray-100">
						<th class="border border-gray-300 p-2 text-left">Nome</th>
						<th class="border border-gray-300 p-2 text-left">Produtos</th>
						<th class="border border-gray-300 p-2 text-left">Criado em</th>
						<th class="border border-gray-300 p-2 text-left">Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td class="border border-gray-300 p-2">{{ $category->name }}</td>
							<td class="border border-gray-300 p-2">{{ $category->products_count }} produto(s)</td>
							<td class="border border-gray-300 p-2">{{ $category->created_at->format('d/m/Y') }}</td>
							<td class="border border-gray-300 p-2">
								<div class="flex gap-2">
									<a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:underline">Ver</a>
									<a href="{{ route('categories.edit', $category) }}" class="text-green-600 hover:underline">Editar</a>
									<form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
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
			<p class="text-gray-600 mb-4">Nenhuma categoria cadastrada.</p>
			<a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Criar Primeira Categoria</a>
		</div>
	@endif
</div>
@endsection

