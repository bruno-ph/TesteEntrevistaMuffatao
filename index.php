<?php
include('function.php');
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['preco'])){
        $nome_post = $_POST["nome"];
        $preco_post = $_POST["preco"];
        if (!empty($nome_post) and !empty($preco_post) and is_numeric($preco_post)){
            createProduct($nome_post,$preco_post);
        }
    } else if (isset($_POST['delete_id'])) {
        $delete_id_post = $_POST["delete_id"];
         if (!empty($delete_id_post)){
            deleteProduct($delete_id_post);
         }
    }
}
$sql="SELECT * from produtos";
$result=$conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="export.php" method="POST">
        <button type="submit">PDF</button>
    </form>

    <h1>Lista de Produtos</h1>
    <table>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            
            <tr>
                <td> <?php echo htmlspecialchars($row['nome']); ?></td>
                <td> R$<?php echo htmlspecialchars($row['preco']); ?></td>
                <td> <form action="index.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'];?>" name="delete_id">
                    <button>Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php if ($result->num_rows == 0): ?>
            <p>Não há produtos cadastrados</p>
        <?php endif; ?>
    </table>
   

    <form class="add_user_form" action="index.php" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome">
        <label for="preco">Preço</label>
        <input type="number" step=0.01 id="preco" name="preco">
        <button class="add_user_submit_button" type="submit">Adicionar produto</button>
    </form>
</body>
</html>
