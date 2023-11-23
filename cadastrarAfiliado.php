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
    $afiliado = array(
        'nome' => $nome,
        'email' => $email,
        'endereco' => $endereco,
        'numero' => $numero,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'estado' => $estado
    );

    $_SESSION['listarAfiliados'][] = $afiliado;

    header('Location:listarAfiliados.php');
}
?>
