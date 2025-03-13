<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/style_cadastro.css">
    <title>Cadastro de Clientes</title>    
</head>

<body>

<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];

    $stmt = $conn->prepare("INSERT INTO clientes (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $data_nascimento, $telefone);
    
    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Cliente cadastrado com sucesso!',
                    showConfirmButton: false,
                    backdrop:'rgb(167, 224, 169)',
                    timer: 1500
                }).then(() => {
                    window.location.href = 'cadastro.php';
                });
              </script>";
    } else {
        $error = addslashes($stmt->error);
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    html: 'Erro ao cadastrar cliente:<br>{$error}'
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }
    exit; // Impede a execução do restante do código após o redirect
}
?>

    <h1>Cadastro de Clientes</h1>

    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Aniversariantes do Mês</h2>
    <a href="aniversariantes.php">Ver aniversariantes deste mês</a>
</body>
</html>