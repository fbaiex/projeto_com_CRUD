<?php include('conexao.php');

$sql_clientes = "SELECT * FROM clientes";

$query_clientes = $mysqli -> query($sql_clientes) or die($mysqli -> error);

$num_clientes = $query_clientes -> num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
</head>
<body>
    <h1>Lista de clientes</h1>
    <p>Esses são os clientes cadastrados no sistema: </p>
    <table border="1" cellpadding="10">
        <thead>
            <th>
                ID
            </th>
            <th>
                Nome
            </th>
            <th>
                E-mail
            </th>
            <th>
                Telefone
            </th>
            <th>
                Data de Nascimento
            </th>
            <th>
                Data de cadastro
            </th>
            <th>
                Ações
            </th>
        </thead>
        <tbody>
            <?php if($num_clientes == 0) { ?>
                <tr>
                    <td coldspan="7">Nenhum cliente cadastrado</td>
                </tr>
            <?php }else { 
                while($clientes = $query_clientes -> fetch_assoc()) {

                    $telefone = "Não informado";
                    if(!empty($clientes['telefone'])) {
                        $ddd = substr($clientes['telefone'], 0, 2);
                        $parteum = substr($clientes['telefone'], 2, 5);
                        $partedois = substr($clientes['telefone'], 7);
                        $telefone = "($ddd) $parteum-$partedois";
                    }
                    $nascimento = "Não informado";
                    if(!empty($clientes['nascimento'])) {
                        $nascimento = implode('/', array_reverse(explode('-', $clientes['nascimento'])));

                    }

                    $data_cadastro = date("d/m/y H:i", strtotime($clientes['data']));
                ?>
                <tr>
                    <td>
                        <?php echo $clientes['id']; ?>
                    </td>
                    <td>
                        <?php echo $clientes['nome']; ?>
                    </td>
                    <td>
                        <?php echo $clientes['email']; ?>
                    </td>
                    <td>
                        <?php echo $telefone; ?>
                    </td>
                    <td>
                        <?php echo $nascimento; ?>
                    </td>
                    <td>
                        <?php echo $data_cadastro; ?>
                    </td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $clientes['id']; ?>">
                            Editar
                        </a>
                        <a href="deletar_cliente.php?id=<?php echo $clientes['id']; ?>">
                            Deletar
                        </a>
                    </td>
                </tr>
            <?php   }
         } ?>

        </tbody>
    </table>
</body>
</html>