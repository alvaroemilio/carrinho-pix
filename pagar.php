<?php
include('phpqrcode/qrlib.php');

$valor = isset($_POST['totalGeral']) ? floatval($_POST['totalGeral']) : 0.0;

function gerarCodigoPix($chave, $nome, $cidade, $valor) {
    $valorFormatado = number_format($valor, 2, '.', '');

    // Monta o payload Pix conforme padrão do BACEN
    $payload = "000201";
    $payload .= "26330014BR.GOV.BCB.PIX";
    $payload .= "01" . str_pad(strlen($chave), 2, '0', STR_PAD_LEFT) . $chave;
    $payload .= "52040000";
    $payload .= "5303986";

    if ($valor > 0) {
        $payload .= "54" . str_pad(strlen($valorFormatado), 2, '0', STR_PAD_LEFT) . $valorFormatado;
    }

    $payload .= "5802BR";
    $payload .= "59" . str_pad(strlen($nome), 2, '0', STR_PAD_LEFT) . $nome;
    $payload .= "60" . str_pad(strlen($cidade), 2, '0', STR_PAD_LEFT) . $cidade;
    $payload .= "62070503***";
    $payload .= "6304";

    return $payload . calcularCRC16($payload);
}

function calcularCRC16($str) {
    $polinomio = 0x1021;
    $crc = 0xFFFF;

    for ($i = 0; $i < strlen($str); $i++) {
        $crc ^= ord($str[$i]) << 8;
        for ($j = 0; $j < 8; $j++) {
            $crc = ($crc & 0x8000) ? ($crc << 1) ^ $polinomio : $crc << 1;
        }
    }
    return strtoupper(dechex($crc & 0xFFFF));
}


$chavePix = ""; // Exemplo de chave Pix válida
$nomeRecebedor = "";
$cidadeRecebedor = "";

$codigoPix = gerarCodigoPix($chavePix, $nomeRecebedor, $cidadeRecebedor, $valor);


QRcode::png($codigoPix);


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .info { margin-top: 20px; }
        .qr-code { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Pagamento via Pix</h1>
    <div class="info">
        <p><strong>Nome do Recebedor:</strong> <?php echo $nomeRecebedor; ?></p>
        <p><strong>Cidade:</strong> <?php echo $cidadeRecebedor; ?></p>
        <p><strong>Valor a Pagar:</strong> R$ <?php echo number_format($valor, 2, ',', '.'); ?></p>
    </div>
    <div class="qr-code">
        <h2>QR Code para Pagamento</h2>
        <img src="<?php echo 'data:image/png;base64,' . base64_encode(QRcode::png($codigoPix, false)); ?>" alt="QR Code do Pagamento">
    </div>
</body>
</html>
