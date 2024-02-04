<?php
session_start();
$nome = $_POST['nome']; 
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$mensagemErro = '';
echo $nome;

if ($nome == '') {
    $mensagemErro .= 'Nome vazio<br/>';
}
if ($email == '') {
    $mensagemErro .= 'E-mail vazio<br/>';
}
if ($endereco == '') {
    $mensagemErro .= 'Endereço vazio<br/>';
}
if ($numero == '') {
    $mensagemErro .= 'Número vazio <br/>';
}
if ($bairro == '') {
    $mensagemErro .= 'Bairro vazio<br/>';
}
if ($cidade == '') {
    $mensagemErro .= 'Cidade vazia<br/>';
}
if ($estado == '') {
    $mensagemErro .= 'Estado vazio<br/>';
}

if ($mensagemErro != '') {
    echo "ERRO DETECTADO: <br/>";
    echo $mensagemErro;
} else {
    try{
    // Conexão com o banco de dados (substitua os valores pelos seus próprios)
    $pdo = new PDO('mysql:host=localhost;dbname=venus', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar e executar a instrução SQL de inserção
    $stmt = $pdo->prepare("INSERT INTO afiliados (nome, email, endereco, numero, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $endereco, $numero, $bairro, $cidade, $estado]);

    // Redirecionar para a página listarAfiliados.php
    header('Location: listarAfiliados.php');
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

}
?>
