<?php

include('conexao.php');

$id = intval($_GET['id']);

function limpar_texto($telefone) {
    return preg_replace("/[^0-9]/", "", $telefone);
}

    if(count($_POST) > 0) {

        $erro = false;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        $admin = $_POST['admin'];

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
            $sql_code = "UPDATE clientes SET nome = '$name',
            email = '$email',
            telefone = '$telefone',
            nascimento = '$nascimento',
            admin = '$admin' WHERE id = '$id'";
            $deu_certo = $mysqli -> query($sql_code) or die($mysqli ->error);
            if($deu_certo) {
                echo "<p><b> Cliente atualizado com sucesso!</b></p>";
                unset($_POST);
            }
        }
    }


$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli -> query($sql_cliente) or die($mysqli -> error);
$cliente = $query_cliente -> fetch_assoc();
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
            <input value="<?php echo $cliente['nome']; ?>" name="name" type="text">
        </p>
        <p>
            <label>E-mail: </label>
            <input value="<?php echo $cliente['email']; ?>" name="email" type="text"><br/><br />
        </p>
        <p>
            <label>Telefone: </label>
            <input value="<?php if(!empty($cliente['telefone'])) echo formatar_telefone($cliente['telefone']); ?>" placeholder="(11) 8888-9999" name="telefone" type="text"><br/><br />
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input value="<?php if(!empty($cliente['nascimento'])) echo formatar_data($cliente['nascimento']); ?>" placeholder="19/02/1994" name="nascimento" type="text"><br/><br />
        </p>
        <p>
            <label>Tipo:</label>
            <input name="admin" value="1" type="radio">Admin
            <input name="admin" value="0" checked type="radio">Cliente
        </p>
        <p>
            <button type="submit">Salvar</button>
        </p>
    </form>

</body>
</html>