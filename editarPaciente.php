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
    $mensagem = $_POST['mensagem'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $profissional = $_POST['profissional'];
    $procedimento = $_POST['procedimento'];

    // Validar os campos
    if ($nome == '' || $email == '' || $cpf == '' || $data == '') {
        $mensagemErro .= 'Nome, E-mail, CPF e Data são campos obrigatórios.<br/>';
    }

    if ($mensagemErro == '') {
        // Atualizar os dados no banco de dados
        $query = $conexao->prepare('UPDATE pacientes SET nome=?, email=?, mensagem=?, cpf=?, data=?, profissional=?, procedimento=? WHERE id=?');
        $query->execute([$nome, $email, $mensagem, $cpf, $data, $profissional, $procedimento, $id]);

        // Redirecionar de volta à página principal
        header('Location: listarPacientes.php');
        exit();
    } else {
        echo "ERRO DETECTADO: <br>";
        echo $mensagemErro;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Obter os dados do paciente do banco de dados
    $query = $conexao->prepare('SELECT * FROM pacientes WHERE id=:id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $paciente = $query->fetch(PDO::FETCH_ASSOC);


    if (!$paciente) {
        // Se o paciente não for encontrado, você pode redirecionar para uma página de erro ou fazer algo apropriado.
        echo "Paciente não encontrado.";
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
    <title>Formulário de Agendamento</title>
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

    <br><br><br><br><br><br>

    <h1>Formulário de Agendamento</h1>

    <section>
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" value="<?= $paciente['nome'] ?>"><br>

                <label for="email">E-mail:</label><br>
                <input type="email" id="email" name="email" placeholder="exemplo@dominio.com" value="<?= $paciente['email'] ?>"><br>

                <label for="mensagem">Mensagem:</label><br>
                <textarea rows="4" cols="50" id="mensagem" name="mensagem" placeholder="Escreva sua mensagem"><?= $paciente['mensagem'] ?></textarea><br>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this)" value="<?= $paciente['cpf'] ?>">

                <label for="data">Data:</label>
                <input type="date" name="data" value="<?= $paciente['data'] ?>"><br>

                <label for="profissional">Profissional:</label>
                <select id="profissional" name="profissional">
                    <option value="Marcelo Arcaico" <?= ($paciente['profissional'] == 'Marcelo Arcaico') ? 'selected' : '' ?>>Dr Marcelo Arcaico</option>
                    <option value="Anna" <?= ($paciente['profissional'] == 'Anna') ? 'selected' : '' ?>>Drª anna Freitas</option>
                    <option value="Claudia" <?= ($paciente['profissional'] == 'Claudia') ? 'selected' : '' ?>>Drª claudia Alves </option>
                    <option value="Julia" <?= ($paciente['profissional'] == 'Julia') ? 'selected' : '' ?>>Drª julia Tenório</option>
                </select><br>

                <label for="procedimento">Procedimento:</label>
                <select id="procedimento" name="procedimento">
                    <option value="Harmonização" <?= ($paciente['procedimento'] == 'Harmonização Facial') ? 'selected' : '' ?>>Harmonização Facial</option>
                    <option value="Preenchimento" <?= ($paciente['procedimento'] == 'Preenchimento labial') ? 'selected' : '' ?>>Preenchimento labial</option>
                    <option value="Peeling" <?= ($paciente['procedimento'] == 'Peeling Químico') ? 'selected' : '' ?>>Peeling Químico</option>
                    <option value="Botox" <?= ($paciente['procedimento'] == 'Toxina Botulínica') ? 'selected' : '' ?>>Toxina Botulínica</option>
                    <option value="Microagulhamento" <?= ($paciente['procedimento'] == 'Microagulhamento') ? 'selected' : '' ?>>Microagulhamento</option>
                    <option value="Drenagem" <?= ($paciente['procedimento'] == 'Drenagem Linfática') ? 'selected' : '' ?>>Drenagem Linfática</option>
                    <option value="Depilação" <?= ($paciente['procedimento'] == 'Depilação a Laser') ? 'selected' : '' ?>>Depilação a Laser</option>
                </select><br>

                <input type="submit" value="Salvar Alterações" name='editar'><br />
            </div>
        </form>
    </section>

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