<?php
session_start();
$nome = $_POST['nome']; 
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$cpf = $_POST['cpf'];
$data = $_POST['data'];
$profissional = $_POST['profissional'];
$procedimento = $_POST['procedimento'];
$mensagemErro = '';
echo $nome;

if ($nome == '') {
    $mensagemErro .= 'Nome vazio<br/>';
}
if ($email == '') {
    $mensagemErro .= 'E-mail vazio<br/>';
}
if ($cpf == '') {
    $mensagemErro .= 'CPF vazio<br/>';
}
if ($data == '') {
    $mensagemErro .= 'Data vazia<br/>';
}

if ($mensagemErro != '') {
    echo "ERRO DETECTADO: <br/>";
    echo $mensagemErro;
} else {
    $paciente = array(
        'nome' => $nome,
        'email' => $email,
        'mensagem' => $mensagem,
        'cpf' => $cpf,
        'data' => $data,
        'profissional' => $profissional,
        'procedimento' => $procedimento
    );
    
    $_SESSION['listarPacientes'][] = $paciente;
    
 header('Location: listarPacientes.php');
   // exit();   Certifique-se de sair para evitar execução adicional do código

}
?>              
