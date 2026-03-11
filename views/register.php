<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
    <body>
        <form method="post">
            <div class="input-form" data-name="login">
                <label for="input-login">Login</label>
                <input type="text" name="login" id="input-login" class="json-value" required>
                <span class="error-message"></span>
            </div>

            <div class="input-form" data-name="email">
                <label for="input-email">E-mail</label>
                <input type="email" name="email" id="input-email" class="json-value" required>
                <span class="error-message"></span>
            </div>

            <div class="input-form" data-name="password">
                <label for="input-password">Password</label>
                <input type="password" name="pass" id="input-password" class="json-value" required>
            </div>

            <div class="input-form" data-name="password-confirmation">
                <label for="input-password-confirmation">Confirm password</label>
                <input type="password" name="confirm_pass" id="input-password-confirmation" class="json-value" required>
                <span class="error-message"></span>
            </div>
            <button id="button-submit" type="button">Login</button>
        </form>  
    </body>
    <script src="../js/register.js"></script>
</html>