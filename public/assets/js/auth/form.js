document.querySelector('form')?.addEventListener('submit', function (e) {
    const password = document.getElementById('password')?.value.trim() || '';
    const compare = document.getElementById('password-compare');

    if (password.length > 100) {
        e.preventDefault();
        alert('A senha não pode ter mais de 100 caracteres.');
        return;
    }

    if (compare) {
        const compareValue = compare.value.trim();
        if (password !== compareValue) {
            e.preventDefault();
            compare.classList.add('is-invalid');
            const span = document.querySelector('#spa-password');
            if (span) span.innerText = 'As senhas não conferem.';
        } else {
            compare.classList.remove('is-invalid');
        }
    }
});
