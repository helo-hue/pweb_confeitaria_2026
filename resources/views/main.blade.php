<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - Maison Cerise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Quicksand:wght@500;700&display=swap');

:root {
    --cor-fundo: #fce8e0;
    --cor-primaria: #8b1a1a;
    --cor-secundaria: #f4a0a0;
    --cor-terciaria: #e85d5d;
    --cor-texto: #4a1010;
    --cor-xadrez: rgba(184, 212, 232, 0.25);
}

body {
    background-color: var(--cor-fundo);
    background-image:
        linear-gradient(45deg, var(--cor-xadrez) 25%, transparent 25%),
        linear-gradient(-45deg, var(--cor-xadrez) 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, var(--cor-xadrez) 75%),
        linear-gradient(-45deg, transparent 75%, var(--cor-xadrez) 75%);
    background-size: 40px 40px;
    background-position: 0 0, 0 20px, 20px -20px, -20px 0px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: 'Quicksand', sans-serif;
    color: var(--cor-texto);
    padding-top: 56px; /* altura do navbar */
}

body::before {
    content: '✦';
    position: fixed;
    top: 15%;
    left: 3%;
    font-size: 3rem;
    color: rgba(139, 26, 26, 0.15);
    pointer-events: none;
    z-index: 0;
}

body::after {
    content: '✦';
    position: fixed;
    bottom: 20%;
    right: 3%;
    font-size: 4rem;
    color: rgba(139, 26, 26, 0.1);
    pointer-events: none;
    z-index: 0;
}

/* ===== NAVBAR ===== */
.navbar-cerise {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    background: var(--cor-primaria);
    border-bottom: 3px solid var(--cor-terciaria);
    box-shadow: 0 2px 12px rgba(0,0,0,0.25);
}

.navbar-cerise .navbar-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.navbar-cerise .navbar-brand {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 1.15rem;
    color: white !important;
    text-decoration: none;
    white-space: nowrap;
    letter-spacing: 1px;
}

.navbar-cerise .navbar-brand::before {
    content: '✦ ';
    color: var(--cor-secundaria);
    font-style: normal;
    font-size: 0.8rem;
}

.navbar-cerise .navbar-links {
    display: flex;
    gap: 2px;
    align-items: center;
}

.navbar-cerise .navbar-links a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    padding: 6px 13px;
    border-radius: 20px;
    font-size: 0.82rem;
    font-weight: 700;
    font-family: 'Quicksand', sans-serif;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    transition: all 0.2s;
    white-space: nowrap;
}

.navbar-cerise .navbar-links a:hover {
    background: rgba(255,255,255,0.15);
    color: white;
}

.navbar-cerise .navbar-links a.ativo {
    background: var(--cor-terciaria);
    color: white;
}

/* botão hamburguer mobile */
.navbar-toggle {
    display: none;
    background: none;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 8px;
    color: white;
    padding: 4px 10px;
    font-size: 1.2rem;
    cursor: pointer;
}

@media (max-width: 768px) {
    .navbar-toggle {
        display: block;
    }

    .navbar-cerise .navbar-links {
        display: none;
        position: absolute;
        top: 56px;
        left: 0;
        width: 100%;
        background: var(--cor-primaria);
        border-top: 2px solid var(--cor-terciaria);
        flex-direction: column;
        padding: 12px;
        gap: 6px;
    }

    .navbar-cerise .navbar-links.aberto {
        display: flex;
    }

    .navbar-cerise .navbar-links a {
        width: 100%;
        text-align: center;
    }
}

/* ===== HEADER ===== */
header {
    background: var(--cor-primaria);
    padding: 25px 0;
    text-align: center;
    color: var(--cor-fundo);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    border-bottom: 5px solid var(--cor-terciaria);
    position: relative;
}

header::before {
    content: '★ ★ ★ ★ ★ ★ ★ ★ ★ ★ ★ ★ ★ ★ ★';
    display: block;
    font-size: 0.7rem;
    color: var(--cor-secundaria);
    letter-spacing: 8px;
    margin-bottom: 8px;
}

header img {
    max-width: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
    border: 4px solid var(--cor-secundaria);
}

header h1 {
    margin: 0;
    font-size: 2.2rem;
    font-family: 'Playfair Display', serif;
    font-style: italic;
    letter-spacing: 3px;
    color: white;
}

footer {
    margin-top: auto;
    background-color: var(--cor-primaria);
    color: var(--cor-secundaria);
    text-align: center;
    padding: 15px 0;
    font-weight: bold;
    letter-spacing: 1px;
    border-top: 5px solid var(--cor-terciaria);
}

footer::before {
    content: '★ ';
    color: var(--cor-terciaria);
}

footer::after {
    content: ' ★';
    color: var(--cor-terciaria);
}

.content-container {
    padding: 30px 15px;
    flex: 1;
    position: relative;
    z-index: 1;
}

/* ===== BOTÕES ===== */
.btn-novo {
    background: var(--cor-primaria);
    color: white;
    border: 2px solid var(--cor-primaria);
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 700;
    font-family: 'Quicksand', sans-serif;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 0.82rem;
    transition: all 0.2s;
}

.btn-novo:hover {
    background: white;
    color: var(--cor-primaria);
    border-color: var(--cor-primaria);
}

.btn-voltar {
    background: var(--cor-secundaria);
    color: var(--cor-primaria);
    border: 2px solid var(--cor-primaria);
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.82rem;
}

.btn-voltar:hover {
    background: var(--cor-primaria);
    color: white;
}

.btn-pesquisar {
    background: var(--cor-terciaria);
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.82rem;
}

.btn-pesquisar:hover {
    background: var(--cor-primaria);
    color: white;
}

.btn-editar {
    background: var(--cor-secundaria);
    color: var(--cor-primaria);
    font-weight: 700;
    border: 2px solid var(--cor-primaria);
    border-radius: 20px;
    text-transform: uppercase;
    font-size: 0.78rem;
}

.btn-editar:hover {
    background: var(--cor-primaria);
    color: white;
}

.btn-excluir {
    background: var(--cor-primaria);
    color: white;
    font-weight: 700;
    border: none;
    border-radius: 20px;
    text-transform: uppercase;
    font-size: 0.78rem;
}

.btn-excluir:hover {
    background: var(--cor-terciaria);
    color: white;
}

.btn-entregar {
    background: var(--cor-terciaria);
    color: white;
    font-weight: 700;
    border: none;
    border-radius: 20px;
    text-transform: uppercase;
    font-size: 0.78rem;
}

.btn-entregar:hover {
    background: var(--cor-primaria);
    color: white;
}

.btn-calcular {
    background: var(--cor-terciaria);
    color: white;
    font-weight: 700;
    border-radius: 20px;
}

/* ===== TABELAS ===== */
.table-custom {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    box-shadow: 0 4px 16px rgba(139,26,26,0.15);
    border: 2px solid var(--cor-primaria);
    border-radius: 16px;
    overflow: hidden;
    background: white;
}

.table-custom th {
    background: var(--cor-primaria);
    color: white;
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-style: italic;
    letter-spacing: 1px;
    padding: 14px;
}

.table-custom td {
    text-align: center;
    vertical-align: middle;
    padding: 10px;
    border-bottom: 1px solid #f4d0d0;
}

.table-custom tr:nth-child(even) td {
    background-color: #fff5f5;
}

.table-custom tr:hover td {
    background-color: #fce8e0;
    color: var(--cor-primaria);
}

/* ===== STATUS ===== */
.status-pendente {
    background: var(--cor-secundaria);
    color: var(--cor-primaria);
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.status-entregue {
    background: var(--cor-primaria);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.status-atrasado {
    background: #c0392b;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ===== TÍTULOS ===== */
h2, h3 {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    color: white;
    background: var(--cor-primaria);
    display: inline-block;
    padding: 6px 24px;
    border-radius: 4px;
    position: relative;
    box-shadow: 4px 4px 0px var(--cor-terciaria);
}

h2::before, h3::before {
    content: '✦ ';
    font-style: normal;
    color: var(--cor-secundaria);
}

h2::after, h3::after {
    content: ' ✦';
    font-style: normal;
    color: var(--cor-secundaria);
}

/* ===== FORMULÁRIOS ===== */
.form-control, .form-select {
    border: 2px solid var(--cor-secundaria);
    border-radius: 12px;
}

.form-control:focus, .form-select:focus {
    border-color: var(--cor-primaria);
    box-shadow: 0 0 0 0.2rem rgba(139,26,26,0.15);
}

.border {
    border-color: var(--cor-secundaria) !important;
    border-radius: 12px !important;
    background: white;
}

/* ===== ALERTAS ===== */
.alert-success {
    background: #fce8e0;
    border-color: var(--cor-terciaria);
    color: var(--cor-primaria);
}

.alert-danger {
    background: #fff0f0;
    border-color: var(--cor-primaria);
    color: var(--cor-primaria);
}

/* ===== CARDS PRODUTOS ===== */
#produtosGrid {
    row-gap: 20px;
}

.produto-card {
    background: white;
    border: 2px solid var(--cor-secundaria);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 4px 4px 0px var(--cor-secundaria);
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.produto-card:hover {
    transform: translateY(-4px);
    box-shadow: 6px 6px 0px var(--cor-terciaria);
}

.produto-img-wrapper {
    width: 100%;
    height: 180px;
    background: var(--cor-fundo);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.produto-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* ===== CARDS CLIENTES ===== */
.cliente-img-wrapper {
    width: 100%;
    height: 180px;
    background: var(--cor-fundo);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.cliente-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.produto-info {
    padding: 10px;
    flex: 1;
}

.produto-info h6 {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    color: var(--cor-primaria);
    font-size: 0.95rem;
    margin-bottom: 4px;
    background: none;
    box-shadow: none;
    padding: 0;
    display: block;
}

.produto-info h6::before,
.produto-info h6::after {
    content: none;
}

.produto-info p {
    font-size: 0.75rem;
    color: var(--cor-texto);
    margin-bottom: 2px;
}

.produto-valor {
    font-weight: 700;
    color: var(--cor-primaria) !important;
    font-size: 0.9rem !important;
}

.produto-acoes {
    padding: 8px 10px;
    display: flex;
    gap: 6px;
    justify-content: center;
    border-top: 1px solid #f4d0d0;
}

.produto-card-novo {
    border: 2px dashed var(--cor-terciaria);
    box-shadow: none;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: var(--cor-primaria);
    background: #fff5f5;
}

.produto-card-novo:hover {
    background: var(--cor-fundo);
    box-shadow: 4px 4px 0px var(--cor-secundaria);
}

.produto-card-novo .produto-info h6 {
    color: var(--cor-primaria);
}
    </style>
</head>

<body>

    {{-- NAVBAR FIXO --}}
    <nav class="navbar-cerise">
        <div class="navbar-inner">
            <a href="{{ route('welcome') }}" class="navbar-brand">Maison Cerise</a>

            <button class="navbar-toggle" onclick="toggleMenu()">☰</button>

            <div class="navbar-links" id="navbarLinks">
                <a href="{{ route('pedidos.index') }}"
                   class="{{ request()->routeIs('pedidos.*') ? 'ativo' : '' }}">
                    📋 Pedidos
                </a>
                <a href="{{ route('entregas.index') }}"
                   class="{{ request()->routeIs('entregas.*') ? 'ativo' : '' }}">
                    🚗 Entregas
                </a>
                <a href="{{ route('receitas.index') }}"
                   class="{{ request()->routeIs('receitas.*') ? 'ativo' : '' }}">
                    📖 Receitas
                </a>
                <a href="{{ route('clientes.index') }}"
                   class="{{ request()->routeIs('clientes.*') ? 'ativo' : '' }}">
                    👤 Clientes
                </a>
                <a href="{{ route('produtos.index') }}"
                   class="{{ request()->routeIs('produtos.*') ? 'ativo' : '' }}">
                    🎂 Produtos
                </a>
                <a href="{{ route('relatorios.index') }}"
                   class="{{ request()->routeIs('relatorios.*') ? 'ativo' : '' }}">
                    📊 Relatórios
                </a>
            </div>
        </div>
    </nav>



    <main class="content-container">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Por favor, verifique os erros abaixo:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('sucesso'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('sucesso') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('erro'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ session('erro') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('conteudo')
        </div>
    </main>

    <footer>
        &copy; 2026 Maison Cerise — Feito com Amor & Cerise
        Trabelha conosco: Telefone: (11) 1234-5678 | Email: contato@maisoncerise.com
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        function toggleMenu() {
            document.getElementById('navbarLinks').classList.toggle('aberto');
        }
    </script>
</body>

</html>