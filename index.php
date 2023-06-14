<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="divlogin">
        <form class="card">
            <div class="card-header">
                <h1>Tela de Login</h1>
            </div>
        
            <div class="card-content">
                <div class="card-content-area">
                    <label for="">E-mail:</label>
                    <input type="text" id="login">
                </div>
                <div class="card-content-area">
                    <label for="">Senha:</label>
                    <input type="password" id="senha">
                    <br/>
                    <input type="submit" onclick="logar(); return false">
                </div>
            </div>
        </form>
    </div>
    <script>
        function logar(){
            var login = document.getElementById('login').value;
            var senha = document.getElementById('senha').value;

            if(login == "admin" && senha == "admin") {
                window.location = "cadastrar_cliente.php";
            }else{
                alert('Usuario ou senha incorretos');
            }
        }
        console.log(window.location.href);
    </script>
</body>
</html>