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

if (isset($_POST['salvarEdicao'])) {
    $indice = $_POST['indice'];

    // Obtenha os dados editados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $profissional = $_POST['profissional'];
    $procedimento = $_POST['procedimento'];

    // Atualize os dados no banco de dados
    $query = $conexao->prepare('UPDATE pacientes SET nome=?, email=?, mensagem=?, cpf=?, data=?, profissional=?, procedimento=? WHERE id=?');
    $query->execute([$nome, $email, $mensagem, $cpf, $data, $profissional, $procedimento, $indice]);

    // Redirecione de volta à página principal
    header('Location: listarPacientes.php');
    exit();
}

$indice = $_GET['indice'];
echo "Índice: $indice";  // Adicione esta linha


// Obtenha os dados do paciente com base no índice
$query = $conexao->prepare('SELECT * FROM pacientes WHERE id=?');
$query->execute([$indice]);
$paciente = $query->fetch(PDO::FETCH_ASSOC);

var_dump($paciente);
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

<h1 class="text-form">Formulário de Edição</h1>

<section>
    <form action="" method="post">

    <div>
    <?php if ($paciente && is_array($paciente)) : ?>
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?= $paciente['nome'] ?>" placeholder="Digite seu nome" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="<?= $paciente['email'] ?>" placeholder="exemplo@dominio.com" required><br>

        <label for="mensagem">Mensagem:</label><br>
        <textarea rows="4" cols="50" id="mensagem" name="mensagem" placeholder="Escreva sua mensagem"><?= $paciente['mensagem'] ?></textarea><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?= $paciente['cpf'] ?>" maxlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this)" required>
        
        <label for="data">Data:</label>
        <input type="date" name="data" value="<?= $paciente['data'] ?>" required><br>

        <label for="profissional">Profissional:</label>
        <select id="profissional" name="profissional">
                <option value="Marcelo Arcaico">Dr Marcelo Arcaico</option>
                <option value="Anna">Drª anna Freitas</option>
                <option value="Claudia">Drª claudia Alves</option>
                <option value="Julia">Drª julia Tenório</option>
            </select><br>

            <label for="procedimento">Procedimento:</label>
              <select id="procedimento" name="procedimento">
                <option value="Harmonização">Harmonização Facial</option>
                <option value="Preenchimento">Preenchimento labial</option>
                <option value="Peeling">Peeling Químico</option>
                <option value="Botox">Toxina Botulínica</option>
                <option value="Microagulhamento">Microagulhamento</option>
                <option value="Drenagem">Drenagem Linfática</option>
                <option value="Depilação">Depilação a Laser</option>
            </select><br>
            <input type="hidden" name="indice" value="<?= $indice ?>">
        <input type="submit" value="Salvar Alterações" name="salvarEdicao"><br />
    <?php else : ?>
        <p>Paciente não encontrado.</p>
    <?php endif; ?>
    </form>
</section>


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