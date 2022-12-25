<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="global.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="shortcut icon" href="https://files.cercomp.ufg.br/weby/up/267/o/Logomarca_Dona_Iris.png" type="image/x-ico">
    <title>Login</title>
</head>
<body>
    <?php
    //Exemplo criptografar a senha
    //echo password_hash("@Dona!Ir13s.", PASSWORD_DEFAULT);
    ?>
    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($dados['SendLogin'])) {
        //var_dump($dados);
        $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                        FROM usuarios 
                        WHERE usuario =:usuario  
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: dashboard.php");
            }else{
                $_SESSION['msg'] = //criar um alerta que fique fluindo na tela com o bootstrap
                "
                <div class='col-4'>
                <div class=' alerta' role='alert'>
                    Login ou Senha inválida!
                </div>
                </div>
                ";
            }
        }else{
            $_SESSION['msg'] =  //criar um alerta que fique fluindo na tela com o bootstrap
                "
                <div class='col-4'>
                <div class=' alerta' role='alert'>
                    Login ou Senha inválida!
                </div>
                </div>
                ";
        }
    }
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 bg-login">
                <h1 class="text-light">Login</h1>
                <form method="POST" action="">
                <div class="form-group col-md-10">
                    <label class="text-light">Usuário</label>
                    <input type="text" name="usuario" placeholder="Digite o usuário" class="form-control" id="exampleInputEmail1" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"><br><br>
                    <label class="text-light">Senha</label>
                </div>
                <div class="form-group col-md-10">
                    <input type="password" class="form-control" name="senha_usuario"  placeholder="Digite a senha" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"><br><br>
                    <input type="submit" class="btn btn-primary" value="Acessar" name="SendLogin">
                </div>
                </form>
            </div>
            <div class="col-8 bg-img">
            <img id="img" class="imgagem" alt="Imagem responsiva"></img>
        </div>
        </div>
        </div>
    </div>
    <script src="global.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>