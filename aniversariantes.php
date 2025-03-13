<?php
include('conexao.php');

$mes_atual = date('m');
$stmt = $conn->prepare("SELECT nome, data_nascimento, telefone FROM clientes WHERE MONTH(data_nascimento) = ?");
$stmt->bind_param("s", $mes_atual);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style_aniversariantes.css">
    <title>Aniversariantes do Mês</title>
</head>
<body>
    <h1>Aniversariantes deste Mês</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['data_nascimento'])) ?></td>
                    <td><?= htmlspecialchars($row['telefone']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Não há aniversariantes este mês.</p>
    <?php endif; ?>
    
    <br>
    <a href="cadastro.php">Voltar para o Cadastro</a>
</body>
</html>