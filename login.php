<?php

session_start();
include_once('templates/header.php');
include_once('control/connection.php');

//Realizando login
if (isset($_POST['login'])) {
    if (empty($_POST['user']) && isset($_POST['login'])) {
        echo '<p class="w-50 text-center p-2 mx-auto my-2 text-light bg-danger"> É necessário informar nome de usuário! </p>';
    }else if(empty($_POST['passwd']) && isset($_POST['login'])){
        echo '<p class="w-50 text-center p-2 mx-auto my-2 text-light bg-danger"> É necessário informar uma senha! </p>';
    } else {
        $user = $_POST['user'];
        $passwd = $_POST['passwd'];
        $stmt = $conn->prepare("SELECT user, passwd FROM users WHERE user=? AND passwd=?");
        //Utilizando sha1 como mecanismo de criptografia de senha
        $stmt->bind_param('ss', $user, sha1($passwd));
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_row();
        if (isset($data)) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        }else{
            echo '<p class="w-50 text-center p-2 mx-auto my-2 text-light bg-secondary"> Tente novamente, dados incorretos! </p>';
        }
    }
}

?>

<div class="main">
    <div class="card flex-column w-25 mx-auto my-5 p-5 shadow">
        <div class="d-flex justify-content-between">
            <h3>Login</h3>
            <a href="index.php" class="btn btn-primary">Início</a>
        </div>
        
        <form action="#" method="post">
            <div class="form-group">
                <input type="text" class="form-control bg-light my-2" name="user" placeholder="Usuário">
            </div>
            <div class="form-group">
                <input type="password" class="form-control bg-light my-2" name="passwd" placeholder="Senha">
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-success my-2 shadow">Entrar</button>
            </div>
        </form>
    </div>
</div>

<?php
include_once('templates/footer.php');
?>