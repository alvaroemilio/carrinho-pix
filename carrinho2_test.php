<?php
session_start();

// Esvaziar o carrinho se solicitado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['esvaziar_carrinho'])) {
    unset($_SESSION['carrinho']); // Esvazia o carrinho
}

// Remover um item do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idProduto = $_POST['id'];
    if (isset($_SESSION['carrinho'][$idProduto])) {
        unset($_SESSION['carrinho'][$idProduto]); // Remove o item do carrinho
    }
}

// // Produtos para simulação
// $produtos = [
//     1 => ['nome' => 'Produto 1', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 1', 'preco' => 1.00],
//     2 => ['nome' => 'Produto 2', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 2', 'preco' => 1.00],
//     3 => ['nome' => 'Produto 3', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 3', 'preco' => 1.00],
//     4 => ['nome' => 'Produto 4', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 4', 'preco' => 1.00],
//     5 => ['nome' => 'Produto 5', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 5', 'preco' => 1.00],
//     6 => ['nome' => 'Produto 6', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 6', 'preco' => 1.00],
//     7 => ['nome' => 'Produto 7', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 7', 'preco' => 1.00],
//     8 => ['nome' => 'Produto 8', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 8', 'preco' => 1.00],
//     9 => ['nome' => 'Produto 9', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 9', 'preco' => 1.00],
//     10 => ['nome' => 'Produto 10', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 10', 'preco' => 1.00],
// ];
// ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="stylecarrinho.css">
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Carrinho de Compras</h1>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="index.php">Home</a>
        <a href="">Produtos</a>
        <a href="carrinho.php">Carrinho</a>
        <a href="#contato">Contato</a>
    </nav>

    <!-- Main Content -->
    <main>
        <?php if (empty($_SESSION['carrinho'])): ?>
            <p>Seu carrinho está vazio.</p>
            <a href="index.php" class="back-button">Voltar para a Página Inicial</a>
        <?php else: ?>
            <!-- Tabela de Itens do Carrinho -->
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalGeral = 0; ?>
                    <?php foreach ($_SESSION['carrinho'] as $idProduto => $quantidade): ?>
                        <?php
                        $produto = $produtos[$idProduto];
                        $total = $produto['preco'] * $quantidade;
                        $totalGeral += $total;
                        ?>
                        <tr class="cart-item">
                            <td><img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>"></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['desc']; ?></td>
                            <td><?php echo $quantidade; ?></td>
                            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $idProduto; ?>">
                                    <button type="submit" class="remove-button">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total Geral: R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></p>
            <form action="" method="post">
                <button type="submit" name="esvaziar_carrinho" class="empty-cart-button">Esvaziar Carrinho</button>
            </form>
            <form action="pagar.php" method="POST">
    <input type="hidden" name="totalGeral" value="<?php echo $totalGeral; ?>">
    <button class="back-button" type="submit">FINALIZAR PEDIDO!</button>
</form>
        <?php endif; ?>
<br>




    </main>
</body>
</html>
