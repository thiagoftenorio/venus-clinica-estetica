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

// Inicializar $_SESSION['listarPacientes'] com dados do banco de dados
$query = $conexao->query('SELECT * FROM pacientes');
$_SESSION['listarPacientes'] = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['deletar'])) {
    $indice = $_POST['indice'];
    unset($_SESSION['listarPacientes'][$indice]);
}

if (isset($_POST['editar'])) {
    $indice = $_POST['indice'];
    header("Location: editarPaciente.php?indice=$indice");
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
    <title>Document</title>
   <link rel="stylesheet" href="css/agendarConsulta.css">

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
    </nav>
</header>

<br><br><br><br><br><br><br>


 <h1 class = "text-form">Lista de Agendamentos</h1>



 <form action='' method='post'>
    <table>
        <thead>
            <tr>
                <!-- Cabeçalhos da tabela -->
                <th>Índice</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Mensagem</th>
                <th>CPF</th>
                <th>Data</th>
                <th>Profissional</th>
                <th>Procedimento</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($_SESSION['listarPacientes'] as $key => $value) {
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$value['nome']."</td>";
                echo "<td>".$value['email']."</td>";
                echo "<td>".$value['mensagem']."</td>";
                echo "<td>".$value['cpf']."</td>";
                echo "<td>".$value['data']."</td>";
                echo "<td>".$value['profissional']."</td>";
                echo "<td>".$value['procedimento']."</td>";
                echo "<td><input type='submit' name='editar' value='Editar' class='botao-editar'/></td>";
                echo "<td><input type='submit' name='deletar' value='Deletar' class='botao-deletar'/></td>";
                echo "<input type='hidden' name='indice' value='$key'/>";
                echo "<input type='hidden' name='nome' value='" . $value['nome'] . "'>";
                echo "<input type='hidden' name='email' value='" . $value['email'] . "'>";
                echo "<input type='hidden' name='mensagem' value='" . $value['mensagem'] . "'>";
                echo "<input type='hidden' name='cpf' value='" . $value['cpf'] . "'>";
                echo "<input type='hidden' name='data' value='" . $value['data'] . "'>";
                echo "<input type='hidden' name='profissional' value='" . $value['profissional'] . "'>";
                echo "<input type='hidden' name='procedimento' value='" . $value['procedimento'] . "'>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<div class="rodape" id="contato">
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
                    <p>Email: Venus.Aesthetics@gmail.com</p>
                    <p>Tel: 82 9958-4003</p>
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
    </div>

</body>
</html>
