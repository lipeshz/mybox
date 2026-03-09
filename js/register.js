const login = document.getElementById('input-login');
const email = document.getElementById('input-email');
const password = document.getElementById('input-password');
const password_confirmation = document.getElementById('input-password-confirmation')
const regex_login = /^[^\s]{6,}$/;
const regex_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const regex_password = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
const errors_container = document.querySelector('.errors');
let isValid = true;
const rows = document.querySelectorAll('.input-form');

function dataValidate(){
    rows.forEach(row => {
        row.addEventListener('input', () => {
            const input = row.querySelector('.json-value');
            const errorSpan = row.querySelector('.error-message');
            const inputName = row.getAttribute('data-name');

            if(!regex_login.test(login)){
            const error = document.createElement('span');
            error.textContent = 'Invalid login!';
            isValid = false;
            }

            if(!regex_email.test(email)){
                const 
                isValid = false;
            }else if(emailVerify(email)){
                isValid = false;
            }

            if(!regex_password.test(password) || !regex_password.test(password_confirmation)){
                isValid = false;
            }else if(password != password_confirmation){
                isValid = false;
            }
        });
    });

    return isValid;
}

async function emailVerify(email){

}