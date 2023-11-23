<?php
session_start();

if (isset($_POST['editar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereço = $_POST['endereço'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $mensagemErro = '';

    // Validação de campos vazios
    if (empty($nome) || empty($email) || empty($endereço) || empty($numero) || empty($bairro) || empty($cidade) || empty($estado)) {
        $mensagemErro .= 'Preencha todos os campos.<br>';
    }

    if ($mensagemErro != '') {
        echo "ERRO DETECTADO: <br/>";
        echo $mensagemErro;
    } else {
        // Recupere o ID do afiliado da URL
        $id = $_POST['id'];

        $afiliado = array(
            'nome' => $nome,
            'email' => $email,
            'endereço' => $endereço,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado
        );
        $_SESSION['listarAfiliados'][$id] = $afiliado;
        header('Location: listarAfiliados.php');
    }
}

if (isset($_GET['id'])) {
    // Recupere o ID do afiliado da URL
    $id = $_GET['id'];

    if (isset($_SESSION['listarAfiliados'][$id])) {
        $afiliado = $_SESSION['listarAfiliados'][$id];
    } else {
        die('Afiliado não encontrado.');
    }
} else {
    die('Acesso incompatível. O ID não foi especificado.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Afiliado</title>
    <link rel="stylesheet" href="css/agendarStyle.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html"><img src="img/logo.png" alt="logo"></a>
        </div>

        <nav>
            <a href="index.html" class="nav-link "> Início</a>
            <a href="NossosServico.html" class="nav-link">Nosso serviços</a>
            <a href="agendar.html" class="nav-link active">Agende aqui!</a>
            <a href="sobre.html" class="nav-link">Sobre nós</a>
            <a href="contato.html" class="nav-link">Contato</a>
        </nav>
    </header>

    <br><br><br><br><br>
    <div>
        <h1>Formulário de edição de afiliado</h1>
        <section>
            <form action="" method="post">
                <div>
                    <label for="nome">Nome:</label><br>
                    <input type="text" id="nome" name="nome" value="<?php echo $afiliado['nome']; ?>"><br>

                    <label for="email">E-mail:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $afiliado['email']; ?>"><br>

                    <label for="endereço">Endereço:</label><br>
                    <input type="text" id="endereço" name="endereço" value="<?php echo $afiliado['endereço']; ?>"><br>

                    <label for="numero">Número:</label><br>
                    <input type="text" id="numero" name="numero" value="<?php echo $afiliado['numero']; ?>"><br>

                    <label for="bairro">Bairro:</label><br>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $afiliado['bairro']; ?>"><br>

                    <label for="cidade">Cidade:</label><br>
                    <input type="text" id="cidade" name="cidade" value="<?php echo $afiliado['cidade']; ?>"><br>

                    <label for="estado">Estado:</label><br>
                    <input type="text" id="estado" name="estado" value="<?php echo $afiliado['estado']; ?>"><br>

                    <input type="submit" value="Salvar Alterações" name="editar"> <br />
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                </div>
            </form>
        </section>  
    </div>

    <div class="rodape" id="contato">
        <div class="rodape-div">
           
