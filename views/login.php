<?php
// Starta a sessão, permitindo usar variáveis de sessão.
session_start();
$err_msg = "";

// Verifica se há erros sendo acusados pelo back-end.
if(isset($_SESSION['login_err'])){
    $err_msg = "Invalid login or password.";
    // Remove os erros caso a página seja recarregada ou os erros sejam resolvidos.
    unset($_SESSION['login_err']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mybox</title>
</head>
    <body>
        <main>
            <form action="../controllers/login.php" method="post">
                <div class="input-form">
                    <label for="input-login">Login</label>
                    <input type="text" name="login" id="input-login">
                </div>

                <div class="input-form">
                    <label for="input-password">Password</label>
                    <input type="password" name="password" id="input-password">
                </div>

                <?= $err_msg; ?>

                <input type="submit">
            </form>    
        </main>
    </body>
</html>