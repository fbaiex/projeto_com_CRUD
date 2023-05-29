<?php

$erro = false;

function limpar_texto($telefone) {
    return preg_replace("/[^0-9]/", "", $telefone);
}

    if(count($_POST) > 0) {

        include('conexao.php');

        $name = $_POST['name'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if(empty($name)) {
            $erro = "Preencha o nome";
        }
        
        if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $erro = "Preencha o e-mail";
        }

        if(!empty($nascimento)) {
            $pedacos = explode('/', $nascimento);
                if(count($pedacos) == 3){
                    $nascimento = implode('-', array_reverse($pedacos));
                }else {
                    $erro = "A data de nascimento deve seguir o padrão dia/mes/ano";
                }

        }

        if(!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11) {
                $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
            }
        }

        if($erro) {
            echo "<p><b>$erro</b></p>";
        }else {
            $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data) VALUES ('$name', '$email', '$telefone', '$nascimento', NOW())";
            $deu_certo = $mysqli -> query($sql_code) or die($mysqli ->error);
            if($deu_certo) {
                echo "<p><b> Cliente cadastrado com sucesso!</b></p>";
                unset($_POST);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de clientes</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form method="POST" action="">
        <p>
            <label>Nome: </label>
            <input value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" name="name" type="text"><br/><br />
        </p>
        <p>
            <label>E-mail: </label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" name="email" type="text"><br/><br />
        </p>
        <p>
            <label>Telefone: </label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'] ?>" placeholder="(11) 8888-9999" name="telefone" type="text"><br/><br />
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'] ?>" placeholder="19/02/1994" name="nascimento" type="text"><br/><br />
        </p>
        <p>
            <button type="submit">Enviar</button>
        </p>
    </form>

</body>
</html>