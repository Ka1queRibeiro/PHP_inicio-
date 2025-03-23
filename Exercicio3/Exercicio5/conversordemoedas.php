<?php
// Função para converter moeda usando a API do ExchangeRate-API
function converterMoeda($valor, $de, $para)
{
    // URL da API com a moeda base definida em $de
    $url = "https://api.exchangerate-api.com/v4/latest/" . $de;

    // Realiza a requisição à API
    $json = file_get_contents($url);
    if ($json === FALSE) {
        return "Erro ao acessar a API.";
    }

    // Decodifica o JSON recebido para um array associativo
    $data = json_decode($json, true);

    // Verifica se a moeda destino existe na resposta
    if (!isset($data['rates'][$para])) {
        return "Moeda destino não suportada.";
    }

    // Obtém a taxa de conversão e realiza o cálculo
    $taxa = $data['rates'][$para];
    $valorConvertido = $valor * $taxa;

    // Formata o resultado com duas casas decimais
    return number_format($valorConvertido, 2, ',', '.');
}

$resultado = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = isset($_POST['valor']) ? floatval($_POST['valor']) : 0;
    $de = isset($_POST['de']) ? $_POST['de'] : 'USD';
    $para = isset($_POST['para']) ? $_POST['para'] : 'BRL';

    $resultado = converterMoeda($valor, $de, $para);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Conversor de Moedas com API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input,
        select {
            padding: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <h1>Conversor de Moedas com API</h1>
    <form method="post" action="">
        <input type="number" step="any" name="valor" placeholder="Valor" required>
        <select name="de">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="BRL">BRL</option>
            <option value="GBP">GBP</option>
        </select>
        para
        <select name="para">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="BRL">BRL</option>
            <option value="GBP">GBP</option>
        </select>
        <input type="submit" value="Converter">
    </form>
    <?php
    if ($resultado !== null) {
        echo "<h2>Resultado: {$resultado}</h2>";
    }
    ?>
</body>

</html>