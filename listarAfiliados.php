<?php
session_start();

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

// Inicializar $_SESSION['listarAfiliados'] com dados do banco de dados
$query = $conexao->query('SELECT * FROM afiliados');
$_SESSION['listarAfiliados'] = $query->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['deletar'])) {
    $indiceDeletar = $_GET['deletar'];

    // Obtenha o ID do afiliado que deseja deletar
    $idAfiliadoDeletar = $_SESSION['listarAfiliados'][$indiceDeletar]['id'];

    // Execute a exclusão no banco de dados
    $queryDelete = $conexao->prepare('DELETE FROM afiliados WHERE id=:id');
    $queryDelete->bindParam(':id', $idAfiliadoDeletar, PDO::PARAM_INT);
    $queryDelete->execute();

    // Remova o afiliado da lista de sessão
    unset($_SESSION['listarAfiliados'][$indiceDeletar]);

    // Redirecione de volta à página principal
    header('Location: listarAfiliados.php');
    exit();
}

if (isset($_POST['editar'])) {
    $indice = $_POST['indice'];
    header("Location: editarAfiliado.php?id=$idAfiliadoEditar");
    exit();
}

// Fechar a conexão no final do script
$conexao = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Afiliados</title>
    <link rel="stylesheet" href="css/ListarAfiliados.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="index.html" ><img src="img/logo.png" alt="logo"></a>
    </div>
    <nav>
        <a href="index.html" class="nav-link "> Início</a>
        <a href="NossosServico.html" class="nav-link">Nosso serviços</a>
        <a href="agendar.html" class="nav-link">Agende aqui!</a>
        <a href="sobre.html" class="nav-link">Sobre nós</a>
        <a href="contato.html" class="nav-link active">Contato</a>
        <a href="filiado.html" class="nav-link">Novo Afiliado</a>
    </nav>
</header>

<br><br><br><br><br><br><br>

<h1 class="text-form">Lista de Afiliados</h1>

<main>
    <table class="tabela">
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>

        <?php
        foreach ($_SESSION['listarAfiliados'] as $key => $value) {
            echo "<form action='' method='post'>";
            echo "<tr>";
            echo "<td>".$value['id']."</td>";
            echo "<td>".$value['nome']."</td>";
            echo "<td>".$value['email']."</td>";
            echo "<td>".$value['endereco']."</td>";
            echo "<td>".$value['numero']."</td>";
            echo "<td>".$value['bairro']."</td>";
            echo "<td>".$value['cidade']."</td>";
            echo "<td>".$value['estado']."</td>";
            echo "<td><a href='editarAfiliado.php?id=" . $value['id'] . "'>Editar</a></td>";
            echo "<td><a href='listarAfiliados.php?deletar=$key'>Deletar</a></td>";
            echo "<input type='hidden' name='indice' value='$key'/>";
            echo "<input type='hidden' name='nome' value='" . $value['nome'] . "'>";
            echo "<input type='hidden' name='email' value='" . $value['email'] . "'>";
            echo "<input type='hidden' name='endereco' value='" . $value['endereco'] . "'>";
            echo "<input type='hidden' name='numero' value='" . $value['endereco'] . "'>";
            echo "<input type='hidden' name='bairro' value='" . $value['bairro'] . "'>";
            echo "<input type='hidden' name='cidade' value='" . $value['cidade'] . "'>";
            echo "<input type='hidden' name='estado' value='" . $value['estado'] . "'>";
            echo "</tr>";
            echo "</form>";
        }
        ?>
    </table>
</main>
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
