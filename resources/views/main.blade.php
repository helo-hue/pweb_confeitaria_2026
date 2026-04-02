<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - Sistema Confeitaria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- CSS padrão da confeitaria -->
    <style>
        /* Cores principais */
        :root {
            --cor-fundo: #fffef5;
            --gradiente-principal: linear-gradient(135deg, #DEBACE, #BA94D1);
            --cor-secundaria: #7F669D;
            --cor-terciaria: #BA94D1;
        }

        body {
            background-color: var(--cor-fundo);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Arial', sans-serif;
        }

        header {
            background: var(--gradiente-principal);
            padding: 20px 0;
            text-align: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        header img {
            max-width: 120px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        footer {
            margin-top: auto;
            background-color: var(--cor-secundaria);
            color: white;
            text-align: center;
            padding: 15px 0;
        }

        .content-container {
            padding: 30px 15px;
            flex: 1;
        }

        /* Botões padrão */
        .btn-novo {
            background: var(--gradiente-principal);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            font-weight: bold;
        }

        .btn-novo:hover {
            background: linear-gradient(135deg, #BA94D1, #7F669D);
            color: white;
        }

        .btn-voltar {
            background: var(--cor-secundaria);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
        }

        .btn-voltar:hover {
            background: var(--cor-terciaria);
            color: white;
        }

        .btn-pesquisar {
            background: var(--cor-terciaria);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
        }

        .btn-pesquisar:hover {
            background: var(--cor-secundaria);
            color: white;
        }

        .btn-editar {
            background: #DEBACE;
            color: var(--cor-secundaria);
            font-weight: bold;
        }

        .btn-editar:hover {
            background: var(--cor-terciaria);
            color: white;
        }

        .btn-excluir {
            background: var(--cor-secundaria);
            color: white;
            font-weight: bold;
        }

        .btn-excluir:hover {
            background: var(--cor-terciaria);
            color: white;
        }

        /* Tabelas padrão */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-custom th {
            background: var(--gradiente-principal);
            color: white;
            text-align: center;
        }

        .table-custom td {
            text-align: center;
            vertical-align: middle;
        }

        .table-custom tr:nth-child(even) td {
            background-color: var(--cor-fundo);
        }

        .table-custom tr:hover td {
            background-color: var(--cor-terciaria);
            color: white;
        }
        .btn-entregar {
        background: var(--gradiente-principal);
        color: white;
        font-weight: bold;
        border: none;
        }

        .btn-entregar:hover {
            opacity: 0.85;
        }
        .status-pendente {
            background: var(--cor-terciaria);
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .status-entregue {
            background: var(--cor-secundaria);
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-calcular {
    background: var(--cor-terciaria);
    color: white;
    font-weight: bold;
}
.status-atrasado {
    background: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 8px;
    font-weight: bold;
}

            </style>
</head>

<body>
    <!-- Header -->
<!-- Header -->
@if(empty($semCabecalho))

<header>
    <img src="{{ asset('storage/logomel&lavande.jpg') }}" alt="Logo" class="logo">
    <h1>Sistema da Confeitaria</h1>
</header>

@endif
    <!-- Conteúdo principal -->
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

            @yield('conteudo')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2026 Confeitaria Mel & Lavande
        Trabelha conosco: Telefone: (11) 1234-5678 | Email: contato@mel&lavande.com
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>