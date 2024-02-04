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

// Inicializar $_SESSION['listarcandidatos'] com dados do banco de dados
$query = $conexao->query('SELECT * FROM candidato');
$_SESSION['listarcandidatos'] = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['deletar'])) {
    $indiceDeletar = $_GET['deletar'];


    // Obter o ID do candidato que deseja deletar
    $idCandidatoDeletar = $_SESSION['listarcandidatos'][$indiceDeletar]['id'];

    // Execute a exclusão no banco de dados
    $queryDelete = $conexao->prepare('DELETE FROM candidato WHERE id=:id');
    $queryDelete->bindParam(':id', $idCandidatoDeletar, PDO::PARAM_INT);
    $queryDelete->execute();

    // Remova o Candidato da lista de sessão
    unset($_SESSION['listarcandidatos'][$indiceDeletar]);

    // Redirecione de volta à página principal
    header('Location: listarcandidatos.php');
    exit();
}


if (isset($_POST['editar'])) {
    $indice = $_POST['indice'];
    header("Location: editarCandidatos.php?indice=$indice");
    exit();
}

// Fechar a conexão no final do script
$conexao = null;
?>



<!DOCTYPEs html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/ListarCandidatos.css">

    </head>

    <body>

        <header>
            <div class="logo">
                <a href="index.html"><img src="img/logo.png" alt="logo"></a>
            </div>

            <nav>
                <a href="index.html" class="nav-link "> Início</a>
                <a href="NossosServico.html" class="nav-link">Nosso serviços</a>
                <a href="agendar.html" class="nav-link">Agende aqui!</a>
                <a href="sobre.html" class="nav-link">Sobre nós</a>
                <a href="contato.html" class="nav-link active">Contato</a>
                <a href="candidato.html" class="nav-link">Nova Inscrição </a>
            </nav>
        </header>

        <br><br><br><br><br><br><br><br>


        <h1 class="text-form">Lista Candidatos</h1>


        <main>
            <table class="tabela">
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Escolaridade</th>
                    <th>Função</th>
                    <th>linkedin</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>

                <?php
                foreach ($_SESSION['listarcandidatos'] as $key => $value) {
                    echo "<form action='' method='post'>";
                    echo "<tr>";
                    echo "<td>" . $value['id'] . "</td>";
                    echo "<td>" . $value['nome'] . "</td>";
                    echo "<td>" . $value['email'] . "</td>";
                    echo "<td>" . $value['escolaridade'] . "</td>";
                    echo "<td>" . $value['funcao'] . "</td>";
                    echo "<td>" . $value['linkedin'] . "</td>";
                    echo "<td><a href='editarCandidatos.php?id=" . $value['id'] . "'>Editar</a></td>";
                    echo "<td><a href='listarcandidatos.php?deletar=$key'>Deletar</a></td>";
                    echo "<input type='hidden' name='indice' value='$key'/>";
                    echo "<input type='hidden' name='nome' value='" . $value['nome'] . "'>";
                    echo "<input type='hidden' name='email' value='" . $value['email'] . "'>";
                    echo "<input type='hidden' name='escolaridade' value='" . $value['escolaridade'] . "'>";
                    echo "<input type='hidden' name='funcao' value='" . $value['funcao'] . "'>";
                    echo "<input type='hidden' name='linkedin' value='" . $value['linkedin'] . "'>";
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