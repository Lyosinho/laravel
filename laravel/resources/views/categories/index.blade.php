@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6">
	<h1 class="text-2xl font-bold mb-4">Categorias</h1>

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

	<form method="POST" action="{{ route('categories.store') }}" class="space-y-3 mb-8">
		@csrf
		<div>
			<label class="block mb-1">Nome</label>
			<input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2" required>
		</div>
		<button type="submit" class="bg-blue-600 text-white px-4 py-2">Salvar</button>
	</form>

	<h2 class="text-xl font-semibold mb-2">Lista de Categorias</h2>
	<ul class="space-y-2">
		@forelse($categories as $category)
			<li class="border p-2">{{ $category->name }}</li>
		@empty
			<li class="text-gray-600">Nenhuma categoria cadastrada.</li>
		@endforelse
	</ul>
</div>
@endsection

