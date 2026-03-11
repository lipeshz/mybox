const login = document.getElementById('input-login');
const email = document.getElementById('input-email');
const password = document.getElementById('input-password');
const password_confirmation = document.getElementById('input-password-confirmation');

const regex_login = /^(?=\S{6,}$)[\w.]+$/;
const regex_email = /^(?=\S+$)[^\s@]+@[^\s@]+\.[^\s@]+$/;
const regex_password = /^(?=\S{6,}$)(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/;

function dataValidate() {
    const inputs = document.querySelectorAll('.json-value');

    inputs.forEach(input => {
        const row = input.closest('.input-form');
        const inputName = row.getAttribute('data-name');

        // Validação ao sair do campo (Blur)
        input.addEventListener('blur', async () => {
            await fieldValidate(input, row, inputName);
        });
    });
}

// Transformamos em async para poder esperar o banco de dados
async function fieldValidate(input, row, inputName) {
    let errorsArray = [];
    let errorMsg = "";
    const value = input.value.trim();

    // Se o campo estiver vazio e não for obrigatório, limpamos o erro e paramos
    if(value === "") {
        hideError(row);
        return;
    }

    if (inputName === 'login') {
        if (!regex_login.test(value) || value.trim() === "") {
            errorMsg = 'Login inválido! (6+ caracteres, letras, números ou pontos)';
            errorsArray.push('login_err');
        }else{
            errorsArray = errorsArray.filter(value => value !== 'login_err');
        }
    }

    if (inputName === 'email') {
        if (!regex_email.test(value)) {
            errorMsg = 'E-mail inválido!';
            errorsArray.push('email_err');
        }else{
            // Chamada assíncrona para o banco
            const exists = await emailVerify(value);
            if (exists) {
                errorMsg = 'E-mail já cadastrado!';
                errorsArray.push('email_err');
            }else{
                errorsArray = errorsArray.filter(value => value !== 'email_err')
            }
        }
    }

    if (inputName === 'password' || inputName === 'password-confirmation') {
        // Valida a força da senha
        if (!regex_password.test(password.value)) {
            errorMsg = 'Senha fraca! (6+ caracteres, maiúscula, número e símbolo)';
            errorsArray.push('pass_err');
        } 
        // Valida a confirmação (apenas se ambos tiverem algo)
        else if (password.value && password_confirmation.value && password.value !== password_confirmation.value) {
            errorMsg = 'As senhas não coincidem!';
            errorsArray.push('pass_err');
        }else{
            errorsArray = errorsArray.filter(value => value !== 'pass_err')
        }
    }

    // Feedback Visual
    if (errorMsg) {
        showError(row, errorMsg);
    } else {
        hideError(row);
    }
}

async function isFormValid(){
    // Captura todos os inputs de dados.
    const inputs = document.querySelectorAll('.json-value');
    for(const input of inputs){
        // Itera e define os valores das divs e nomes de campos.
        const row = document.closest('input-form');
        const inputName = document.getAttribute('data-name');

        // Revalida os campos
        await fieldValidate(input, row, inputName);
    }

    // Verifica a quantidade de erros.
    const errors = document.querySelectorAll('.input-error');
    return errors.length === 0;
}

async function sendData(){
    if(await isFormValid()){
        const data = stringBuilder();

        try{
            const response = await fetch('../controllers/register.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if()
        }catch(error){

        }
    }
}

function showError(row, msg) {
    row.classList.add('input-error');
    const span = row.querySelector(".error-message");
    if (span) span.innerText = msg;
}

function hideError(row) {
    row.classList.remove('input-error');
    const span = row.querySelector(".error-message");
    if (span) span.innerText = '';
}

async function emailVerify(emailValue) {
    try {
        const response = await fetch('../controllers/email_verify.php?email=' + encodeURIComponent(emailValue));
        const result = await response.json();
        return result.status === "error";
    } catch (error) {
        console.error('Erro na verificação:', error);
        return false;
    }
}

document.addEventListener('DOMContentLoaded', dataValidate);