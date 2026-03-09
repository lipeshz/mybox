<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
    <body>
        <form method="post">
            <div class="input-form">
                <label for="input-login">Login</label>
                <input type="text" name="login" id="input-login" required>
                
            </div>

            <div class="input-form">
                <label for="input-email">E-mail</label>
                <input type="email" name="email" id="input-email" required>
                <span class="error-message"></span>
            </div>

            <div class="input-form">
                <label for="input-password">Password</label>
                <input type="password" name="pass" id="input-password" required>
            </div>

            <div class="input-form">
                <label for="input-password-confirmation">Confirm password</label>
                <input type="password" name="confirm_pass" id="input-password-confirmation" required>
                <span class="error-message"></span>
            </div>
            <div class="errors">

            </div>
            <?= $err_msg; ?>
            <button>Login</button>
        </form>  
    </body>
</html>