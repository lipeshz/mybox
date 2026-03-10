const login = document.getElementById('input-login');
const email = document.getElementById('input-email');
const password = document.getElementById('input-password');
const password_confirmation = document.getElementById('input-password-confirmation')
const regex_login = /^[\w.]{6,}$/;
const regex_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const regex_password = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
const rows = document.querySelectorAll('.input-form');
const inputs = document.querySelectorAll('.json-value');

function dataValidate(){
    let isValid = true;
    inputs.forEach(input => {
        const row = input.closest('.input-form');
        const inputName = row.getAttribute('data-name');
        input.addEventListener('blur', () => {
            if(row.classList.contains('input-error')){
                fieldValidate(input, row, inputName);
            }
        });

        input.addEventListener('blur', () => {
            fieldValidate(input, row, inputName);
        })
    });
}

function fieldValidate(input, row, inputName){
    let errorMsg = "";
            
    if(inputName === 'login'){
        if(!regex_login.test(login.value) && login.value != ''){
            errorMsg = 'Invalid Login! (6+ chars, letters/numbers/points)';
        }
    }

    // VERIFICAR ISSO AQUI
    const exists = await emailVerify(email.value);
    if(inputName === 'email' && email.value != ''){
        if(!regex_email.test(email.value)){
            errorMsg = 'Invalid E-mail!'
        }else if(exists){
            errorMsg = 'E-mail already registered!';
        }
    }

    if((inputName === 'password-confirmation') && (password != '' && password_confirmation != '')){
        if(!regex_password.test(password.value) || !regex_password.test(password_confirmation.value)){
            errorMsg = 'Invalid password!';
        }else if(password.value !== password_confirmation.value){
            errorMsg = 'Password don\'t match!';
        }
    }

    if(errorMsg){
        showError(row, errorMsg);
    }else{
        hideError(row);
    }
}

function showError(row, msg){
    row.classList.add('.input-error');
    const span = row.querySelector(".error-message");
    if (span) span.innerText = msg;
}

function hideError(row){
    row.classList.remove('.input-error');
    const span = row.querySelector(".error-message");
    if (span) span.innerText = '';
}

async function emailVerify(email){
    try{
        const response = await fetch('../controllers/email_verify.php?email='+encodeURIComponent(email));
        const result = await response.json();
        return result.status === "error";
    }catch(error){
        console.error('Error:' + error);
        return false;
    }
    // const response = await fetch('../controllers/email_verify.php?email='+email, {
    // });
    // try{
    //     const text = await response.text();
    //     console.log(text)
    // }catch(error){

    // }
}

document.addEventListener('DOMContentLoaded', dataValidate);