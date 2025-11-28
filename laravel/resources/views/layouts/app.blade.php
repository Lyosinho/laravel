<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>APS Laravel</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji'; background:#f7fafc; }
		.container { padding: 0 1rem; }
		nav { background:white; border-bottom:1px solid #e2e8f0; }
		nav a { display:inline-block; padding:1rem; color:#1a202c; text-decoration:none; }
		nav a:hover { text-decoration:underline; }
	</style>
</head>
<body>
	<nav>
		<div class="container mx-auto max-w-3xl flex justify-between items-center">
			<div class="flex gap-4">
				<a href="{{ route('products.index') }}">Produtos</a>
				<a href="{{ route('categories.index') }}">Categorias</a>
			</div>
			@if(session('authenticated'))
				<div class="flex items-center gap-4">
					<span>Olá, {{ session('username') }}!</span>
					<form method="POST" action="{{ route('logout') }}" style="display: inline;">
						@csrf
						<button type="submit" style="background: none; border: none; color: inherit; text-decoration: underline; cursor: pointer;">Sair</button>
					</form>
				</div>
			@endif
		</div>
	</nav>
	<main>
		@yield('content')
	</main>
</body>
</html>

