@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md py-6">
	<h1 class="text-2xl font-bold mb-4">Login</h1>

	@if(session('success'))
		<div class="bg-green-100 text-green-800 p-2 mb-4">{{ session('success') }}</div>
	@endif

	@if(session('error'))
		<div class="bg-red-100 text-red-800 p-2 mb-4">{{ session('error') }}</div>
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

	<form method="POST" action="{{ route('login') }}" class="space-y-3">
		@csrf
		<div>
			<label class="block mb-1">Usuário</label>
			<input type="text" name="username" value="{{ old('username') }}" class="w-full border p-2" required>
		</div>
		<div>
			<label class="block mb-1">Senha</label>
			<input type="password" name="password" class="w-full border p-2" required>
		</div>
		<button type="submit" class="bg-blue-600 text-white px-4 py-2">Entrar</button>
	</form>

	<div class="mt-4 p-3 bg-gray-100 text-sm">
		<strong>Credenciais:</strong><br>
		Usuário: admin<br>
		Senha: admin123
	</div>
</div>
@endsection
