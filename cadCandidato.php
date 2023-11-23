<?php
session_start();
$nome = $_POST['nome']; 
$email = $_POST['email'];
$escolaridade = $_POST['escolaridade'];
$funcao = $_POST['funcao'];
$linkedin = $_POST['linkedin'];
$mensagemErro = '';

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
    // Inicialize a sessão como um array se ainda não estiver
    if (!isset($_SESSION['listarcandidatos'])) {
        $_SESSION['listarcandidatos'] = array();
    }

    $candidato = array(
        'nome' => $nome,
        'email' => $email,
        'escolaridade' => $escolaridade,
        'funcao' => $funcao,
        'linkedin' => $linkedin,
    );

    $_SESSION['listarcandidatos'][] = $candidato;

    // Redirecione para a página listarcandidatos.php
    header('Location: listarcandidatos.php');
}
?>
