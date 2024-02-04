<?php
session_start();
$mensagemErro = '';

// Conectar ao banco de dados (substitua as credenciais conforme necessário)
$dsn = 'mysql:host=localhost;dbname=venus';
$usuario_bd = 'root';
$senha_bd = '';

try {
    $conexao = new PDO($dsn, $usuario_bd, $senha_bd);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $mensagemErro .= 'Erro na conexão com o banco de dados: ' . $e->getMessage() . '<br/>';
}

if (isset($_POST['editar'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Validação de campos vazios
    if ($nome == '' || $email == '' || $endereco == '' || $numero == '' || $bairro == '' || $cidade == '' || $estado == '') {
        $mensagemErro .= 'Nome, E-mail, endereco, Bairro, Cidade e Estado são campos obrigatórios.<br/>';
    }
    

    if ($mensagemErro == '') {
        // Atualizar os dados no banco de dados
        $query = $conexao->prepare('UPDATE afiliados SET nome=?, email=?, endereco=?, numero=?, bairro=?, cidade=?, estado=? WHERE id=?');
        $query->execute([$nome, $email, $endereco, $numero, $bairro, $cidade, $estado, $id]);

        // Redirecionar de volta à página principal
        header('Location: listarAfiliados.php');
        exit();

    } else {
        echo "ERRO DETECTADO: <br>";
        echo $mensagemErro;
        
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
// Obter os dados do afiliados do banco de dados
$query = $conexao->prepare('SELECT * FROM afiliados WHERE id=:id');
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$afiliados = $query->fetch(PDO::FETCH_ASSOC);

    if (!$afiliados) {
        // Se o afiliado não for encontrado, você pode redirecionar para uma página de erro ou fazer algo apropriado.
        echo "Afiliado não encontrado.";
        exit();
    }
} else {
    // header('Location: teste.html');
    die('Acesso incompatível');
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
                    <input type="text" id="nome" name="nome" value="<?php echo $afiliados['nome']; ?>"><br>

                    <label for="email">E-mail:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $afiliados['email']; ?>"><br>

                    <label for="endereco">Endereço:</label><br>
                    <input type="text" id="endereco" name="endereco" value="<?php echo $afiliados['endereco']; ?>"><br>

                    <label for="numero">Número:</label><br>
                    <input type="text" id="numero" name="numero" value="<?php echo $afiliados['numero']; ?>"><br>

                    <label for="bairro">Bairro:</label><br>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $afiliados['bairro']; ?>"><br>

                    <label for="cidade">Cidade:</label><br>
                    <input type="text" id="cidade" name="cidade" value="<?php echo $afiliados['cidade']; ?>"><br>

                    <label for="estado">Estado:</label><br>
                    <input type="text" id="estado" name="estado" value="<?php echo $afiliados['estado']; ?>"><br>

                    <input type="submit" value="Salvar Alterações" name="editar"> <br />
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                </div>
            </form>
        </section>  
    </div>

    <footer class="rodape" id="contato">
        <div class="rodape-div">
      
            <div class="rodape-div-1">
                <div class="rodape-div-1-coluna">
                    <!-- elemento -->
                    <span><b>ENDEREÇO</b></span>
                    <p>R. Dr. Jorge de Lima, 113 - Trapiche da Barra, Maceió - AL, 57010-300</p>
                </div>
            </div>
      
            <div class="rodape-div-2">
                <div class="rodape-div-2-coluna">
                    <!-- elemento -->
                    <span><b>Contatos</b></span>
                    <p>Email:  Venus.Aesthetics@gmail.com</p>
                    <p>Tel:  82 9958-4003</p>
                    <a href="candidato.html">Trabalhe conosco</a><br>
                    <a href="filiado.html"> Que se tornar um afiliado?</a>
                </div>
            </div>
      
            <div class="rodape-div-4">
                <div class="rodape-div-4-coluna">
                    <!-- elemento -->
                    <span><b>Desenvolvido por</b></span>
                    <br>
                <ul>
                    <li>Kássio Oliveira</li>
                    <li>Thiago de Freitas</li>
                    <li>Erickson Marcel</li>
                    <li>José Gabriel</li>
                    <li>Felipe Nascimento</li>
                    <li>Marcelo Oliveira</li>
    
      
                    </ul>
                </div>
            </div>
      
        </div>
        <p class="rodape-direitos">Copyright © 2023 – Todos os Direitos Reservados.</p>
    </footer>
    
</body>
</html>
           
