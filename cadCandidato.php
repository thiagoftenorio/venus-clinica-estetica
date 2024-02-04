<?php
session_start();

$nome = $_POST['nome']; 
$email = $_POST['email'];
$escolaridade = $_POST['escolaridade'];
$funcao = $_POST['funcao'];
$linkedin = $_POST['linkedin'];
$mensagemErro = '';

// Validação dos campos
if (empty($nome)) {
    $mensagemErro .= 'Nome vazio<br/>';
}
if (empty($email)) {
    $mensagemErro .= 'E-mail vazio<br/>';
}
if (empty($linkedin)) {
    $mensagemErro .= 'Linkedin vazio<br/>';
}
if (empty($escolaridade)) {
    $mensagemErro .= 'Escolaridade vazia<br/>';
}
if (empty($funcao)) {
    $mensagemErro .= 'Função vazia<br/>';
}

if ($mensagemErro != '') {
    echo "ERRO DETECTADO: <br/>";
    echo $mensagemErro;
} else {
    try {
        // Conexão com o banco de dados (substitua os valores pelos seus próprios)
        $pdo = new PDO('mysql:host=localhost;dbname=venus', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar e executar a instrução SQL de inserção
        $stmt = $pdo->prepare("INSERT INTO candidato (nome, email, escolaridade, funcao, linkedin) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $escolaridade, $funcao, $linkedin]);

        // Redirecionar para a página listarcandidatos.php
        header('Location: listarcandidatos.php');
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
