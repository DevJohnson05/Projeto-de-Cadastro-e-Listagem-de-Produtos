
let btn = document.querySelector('#btn-icon');
let status = true;
btn.addEventListener('click', (e) => {
    e.preventDefault();
    

    if (status) {
        document.querySelector('#icon').setAttribute('class', 'bi bi-eye-slash-fill');
        document.querySelector('#password').setAttribute('type', 'text');
        status = false;
    }else {
        document.querySelector('#icon').setAttribute('class', 'bi bi-eye-fill');
        document.querySelector('#password').setAttribute('type', 'password');
        status = true;
    }
    
});