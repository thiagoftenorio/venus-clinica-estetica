<?php
session_start();
if (isset($_POST['editar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $escolaridade = $_POST['escolaridade'];
    $funcao = $_POST['funcao'];
    $linkedin = $_POST['linkedin'];
    $mensagemErro = '';

    if (empty($nome)) {
        $mensagemErro .= 'Nome vazio<br/>';
    }
    if (empty($email)) {
        $mensagemErro .= 'E-mail vazio<br/>';
    }
    if (empty($linkedin)) {
        $mensagemErro .= 'LinkedIn vazio<br/>';
    }

    if ($mensagemErro != '') {
        echo "ERRO DETECTADO: <br>";
        echo $mensagemErro;
    } else {
        $candidato = array(
            'nome' => $nome,
            'email' => $email,
            'escolaridade' => $escolaridade,
            'funcao' => $funcao,
            'linkedin' => $linkedin,
        );
        $_SESSION['listarcandidatos'][$_GET['id']] = $candidato;
        header('Location: listarcandidatos.php');
    }
}

if (isset($_GET['id'])) {
    $candidato = $_SESSION['listarcandidatos'][$_GET['id']];
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
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                </div>
            </form>
        </section>
    </div>

    
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
                    <a href="candidato.html">Trabalhe conosco</a>
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
