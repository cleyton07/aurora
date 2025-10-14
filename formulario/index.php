<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Viagens | Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a001f, #2a0040);
            color: white;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        .container {
            max-width: 700px;
            margin-top: 80px;
        }
        .card {
            background-color: rgba(30, 0, 50, 0.9);
            border: 1px solid #6a0dad;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(106, 13, 173, 0.4);
        }
        .form-control, .btn {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #6a0dad;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #8c1aff;
            box-shadow: 0 0 15px #8c1aff;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #d4aaff;
        }
        label {
            color: #f0e6ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-5">
            <h2>Entre em Contato ✉️</h2>
            <form action="salvar_contato.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
                </div>
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" id="assunto" name="assunto">
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
            </form>
        </div>
    </div>
</body>
</html>
