@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6">
	<div class="mb-4">
		<a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">← Voltar para Categorias</a>
	</div>

	<h1 class="text-2xl font-bold mb-4">Editar Categoria: {{ $category->name }}</h1>

	@if ($errors->any())
		<div class="bg-red-100 text-red-800 p-2 mb-4">
			<ul class="list-disc ml-6">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-3">
		@csrf
		@method('PUT')
		<div>
			<label class="block mb-1">Nome</label>
			<input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border p-2" required>
		</div>
		<div class="flex gap-2">
			<button type="submit" class="bg-blue-600 text-white px-4 py-2">Atualizar</button>
			<a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-4 py-2">Cancelar</a>
		</div>
	</form>
</div>
@endsection
