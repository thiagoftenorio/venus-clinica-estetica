<?php
session_start();
if (isset($_POST['editar'])) {
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
        echo "ERRO DETECTADO: <br>";
        echo $mensagemErro;
    } else {
        $paciente['nome'] = $nome;
        $paciente['email'] = $email;
        $paciente['mensagem'] = $mensagem;
        $paciente['cpf'] = $cpf;
        $paciente['data'] = $data;
        $paciente['profissional'] = $profissional;
        $paciente['procedimento'] = $procedimento;
        $_SESSION['listarPacientes'][$_GET['id']] = $paciente;
        header('Location: listarPacientes.php');
    }
}
if (isset($_GET['id'])) {

    $paciente = $_SESSION['listarPacientes'][$_GET['id']];
} else {
    // header('Location: teste.html');
    die('Acesso incompativel');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/agendarStyle.css">
</head>
<br><br><br><br><br><br>

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

<body>

    <h1>Formulário de Agendamento</h1>
    <section>
        <form action="" method="post">

            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome"><br>

                <label for="email">E-mail:</label><br>
                <input type="email" id="email" name="email" placeholder="exemplo@dominio.com"><br>


                <label for="mensagem">Mensagem:</label><br>
                <textarea rows="4" cols="50" id="mensagem" name="mensagem" placeholder="Escreva sua mensagem"></textarea><br>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this)">
                <label for="data">Data</label>
                <input type="date" name="data"><br>
                <label for="profissional">Profissional</label>
                <select id="profissional" name="profissional">
                    <option value="Marcelo Arcaico">Dr Marcelo Arcaico</option>
                    <option value="Anna">Drª anna Freitas</option>
                    <option value="Claudia">Drª claudia Alves </option>
                    <option value="Julia"> Drª julia Tenório</option>
                </select><br>
                <label for="procedimento">Procedimento</label>
                <select id="procedimento" name="procedimento">
                    <option value="Harmonização">Harmonização Facial</option>
                    <option value="Preenchimento">Preenchimento labial</option>
                    <option value="Peeling">Peeling Químico</option>
                    <option value="Botox">Toxina Botulínica</option>
                    <option value="Microagulhamento">Microagulhamento</option>
                    <option value="Drenagem">Drenagem Linfática</option>
                    <option value="Depilação">Depilação a Laser</option>
                </select><br>
                <input type="submit" value="Salvar Alterações" name='editar'> <br />
            </div>
        </form>


    </section>
    <script src="contato.js"></script>
    </form>



    </section>


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