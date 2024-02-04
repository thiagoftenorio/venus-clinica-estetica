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
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
    exit();
}

if (isset($_POST['editar'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $escolaridade = $_POST['escolaridade'];
    $funcao = $_POST['funcao'];
    $linkedin = $_POST['linkedin'];

    // Validar os campos
    if ($nome == '' || $email == '' || $linkedin == '') {

        $mensagemErro .= 'Nome, E-mail e LinkedIN são campos obrigatórios.<br/>';
    }

    if ($mensagemErro == '') {
        // Atualizar os dados no banco de dados
        $query = $conexao->prepare('UPDATE candidato SET nome=?, email=?, escolaridade=?, funcao=?, linkedin=? WHERE id=?');
        $query->execute([$nome, $email, $escolaridade, $funcao, $linkedin, $id]);

        // Redirecionar de volta à página principal
        header('Location: listarCandidatos.php');
        exit();
    } else {
        echo "ERRO DETECTADO: <br>";
        echo $mensagemErro;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obter os dados do candidato do banco de dados
    $query = $conexao->prepare('SELECT * FROM candidato WHERE id=:id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $candidato = $query->fetch(PDO::FETCH_ASSOC);

    if (!$candidato) {
        // Se o candidato não for encontrado, você pode redirecionar para uma página de erro ou fazer algo apropriado.
        echo "candidato não encontrado.";
        exit();
    }
} else {
    die('Acesso incompatível');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Candidato</title>
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
        <h1>Formulário de Edição de Candidato</h1>
        <section>
        <form action="" method="post">

                <div>
                    <label for="nome">Nome:</label><br>
                    <input type="text" id="nome" name="nome" value="<?php echo $candidato['nome']; ?>"><br>

                    <label for="email">E-mail:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $candidato['email']; ?>"><br>

                    <label for="escolaridade">Escolaridade</label>
                    <select id="escolaridade" name="escolaridade">
                        <option value="medio" <?php echo ($candidato['escolaridade'] == 'medio') ? 'selected' : ''; ?>>Ensino Médio</option>
                        <option value="tecnico" <?php echo ($candidato['escolaridade'] == 'tecnico') ? 'selected' : ''; ?>>Formação Técnica</option>
                        <option value="faculdade" <?php echo ($candidato['escolaridade'] == 'faculdade') ? 'selected' : ''; ?>>Ensino Superior</option>
                    </select><br>

                    <label for="funcao">Função</label>
                    <select id="funcao" name="funcao">
                        <option value="auxiliar" <?php echo ($candidato['funcao'] == 'auxiliar') ? 'selected' : ''; ?>>Auxiliar Administrativo</option>
                        <option value="tecnico" <?php echo ($candidato['funcao'] == 'tecnico') ? 'selected' : ''; ?>>Técnico Esteticista</option>
                        <option value="medico" <?php echo ($candidato['funcao'] == 'medico') ? 'selected' : ''; ?>>Médico Esteticista</option>
                    </select><br>

                    <label for="linkedin">LinkedIn:</label><br>
                    <input type="text" id="linkedin" name="linkedin" value="<?php echo $candidato['linkedin']; ?>"><br>

                    <input type="submit" value="Salvar Alterações" name="editar"> <br />


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