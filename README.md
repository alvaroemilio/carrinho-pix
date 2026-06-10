# carrinho-pix

# Gerador de QR Code PIX para Carrinho de Compras

Este projeto foi desenvolvido utilizando **PHP**, **HTML** e **CSS** e tem como objetivo simular um carrinho de compras com geração automática de pagamento via **PIX**.

Após a seleção dos produtos e a finalização do carrinho, o sistema gera o código PIX no padrão EMV e utiliza a biblioteca **PHP QR Code** para exibir na tela o **QR Code de pagamento**, permitindo que o usuário realize o pagamento diretamente pelo aplicativo bancário.

- Funcionalidades

* Adição de produtos ao carrinho.
* Cálculo automático do valor total da compra.
* Geração do código PIX dinâmico com valores.
* Exibição do QR Code para pagamento( Aplicar Zoom).

- Requisitos
  PHP 7.4, Apache, Biblioteca PHP QR Code.
  Antes de executar o sistema, é necessário configurar os dados do recebedor PIX no arquivo pagar.php.

- $chavePix = ""; // Exemplo de chave Pix válida
- $nomeRecebedor = "";
- $cidadeRecebedor = "";
