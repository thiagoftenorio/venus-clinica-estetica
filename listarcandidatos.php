<?php
session_start();

if (!isset($_SESSION['listarcandidatos'])) {
    $_SESSION['listarcandidatos'] = array();
}

if (isset($_POST['deletar'])) {
    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['listarcandidatos'][$indice])) {
            unset($_SESSION['listarcandidatos'][$indice]);
        }
    }
}

if (isset($_POST['editar'])) {
    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['listarcandidatos'][$indice])) {
            header('Location: editarCandidatos.php?id=' . $indice);
            exit; // You should exit after a header redirect
        }
    }
}
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

<br><br><br><br><br><br><br><br>


 <h1 class = "text-form">Lista Candidatos</h1>


<main>
<table class = "tabela">
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
            echo "<td>".$key."</td>";
            echo "<td>".$value['nome']."</td>";
            echo "<td>".$value['email']."</td>";
            echo "<td>".$value['escolaridade']."</td>";
            echo "<td>".$value['funcao']."</td>";
            echo "<td>".$value['linkedin']."</td>";
            echo "<td ><input type='submit' name='editar' value='Editar' class='botao-editar'/></td>";
            echo "<td><input type='submit' name='deletar' value='Deletar' class='botao-deletar'/></td>";
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
