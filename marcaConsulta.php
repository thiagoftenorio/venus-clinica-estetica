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
    try {
        // Substitua 'mysql:host=localhost;dbname=nome_do_banco' e 'usuario' e 'senha' pelas suas credenciais
        $conexao = new PDO('mysql:host=localhost;dbname=venus', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar a instrução SQL para inserir dados
        $sql = "INSERT INTO pacientes (nome, email, mensagem, cpf, data, profissional, procedimento)
                VALUES (:nome, :email, :mensagem, :cpf, :data, :profissional, :procedimento)";
        
        // Preparar a declaração PDO
        $stmt = $conexao->prepare($sql);

        // Vincular parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':profissional', $profissional);
        $stmt->bindParam(':procedimento', $procedimento);

        // Executar a declaração
        $stmt->execute();

        echo "Dados inseridos com sucesso!";
        
        // Redirecionar para a página de listarPacientes
        header('Location: listarPacientes.php');
        // exit();   Certifique-se de sair para evitar execução adicional do código
    } catch (PDOException $e) {
        echo "Erro na inserção de dados: " . $e->getMessage();
    }

    // Fechar a conexão
    $conexao = null;
}
?>
