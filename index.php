<?php
session_start();

// Verifica se o carrinho já existe, se não, inicializa
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Produtos disponíveis
$produtos = [
    ['id' => 1, 'nome' => 'Produto 1', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 1', 'preco' => 1.00],
    ['id' => 2, 'nome' => 'Produto 2', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 2', 'preco' => 1.00],
    ['id' => 3, 'nome' => 'Produto 3', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 3', 'preco' => 1.00],
    ['id' => 4, 'nome' => 'Produto 4', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 4', 'preco' => 1.00],
    ['id' => 5, 'nome' => 'Produto 5', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 5', 'preco' => 1.00],
    ['id' => 6, 'nome' => 'Produto 6', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 6', 'preco' => 1.00],
    ['id' => 7, 'nome' => 'Produto 7', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 7', 'preco' => 1.00],
    ['id' => 8, 'nome' => 'Produto 8', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 8', 'preco' => 1.00],
    ['id' => 9, 'nome' => 'Produto 9', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 9', 'preco' => 1.00],
    ['id' => 10, 'nome' => 'Produto 10', 'img' => 'https://via.placeholder.com/150', 'desc' => 'Descrição do Produto 10', 'preco' => 1.00],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = $_POST['id'];
    $_SESSION['carrinho'][$idProduto] = ($_SESSION['carrinho'][$idProduto] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Compras</title>
    <link rel="stylesheet" href="styleindex.css">

</head>

<body>

    <!-- Header -->
    <header>
        <h1>Página de Compras</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Pesquisar produtos...">
            <button onclick="searchProducts()">Pesquisar</button>
        </div>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="#home">Home</a>
        <a href="#produtos">Produtos</a>
        <a href="carrinho2.php">Ver Carrinho</a>
    </nav>

    <!-- Main Content -->
    <main>
        <section class="product-grid" id="productGrid">
            <?php foreach ($produtos as $produto): ?>
            <div class="product-item">
                <h3>
                    <?php echo $produto['nome']; ?>
                </h3>

                <?php if (isset($produto['img'])): ?>
                <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>"
                    style="width:100px;height:auto;">
                <?php endif; ?>

                <h4>
                    <?php echo $produto['desc']; ?>
                </h4>

                <p class="price">R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                    <button type="submit">Adicionar ao Carrinho</button>
                </form>
            </div>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Sua Loja. Todos os direitos reservados.</p>
    </footer>

    <script>
        function searchProducts() {
            const searchTerm = document.getElementById("searchInput").value.toLowerCase();
            const products = document.querySelectorAll(".product-item");

            products.forEach(product => {
                const productName = product.querySelector("h3").innerText.toLowerCase();
                if (productName.includes(searchTerm)) {
                    product.style.display = "block";
                } else {
                    product.style.display = "none";
                }
            });
        }
    </script>

</body>

</html>