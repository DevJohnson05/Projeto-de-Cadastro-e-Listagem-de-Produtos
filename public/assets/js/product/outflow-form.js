document.querySelector('form')?.addEventListener('submit', function (e) {
    const productId = document.getElementById('product_id');
    const quantidade = document.getElementById('quantidade');
    const qtdValor = parseFloat(quantidade.value);
    let valid = true;

    if (!productId.value) {
        valid = false;
        productId.classList.add('is-invalid');
    } else {
        productId.classList.remove('is-invalid');
    }

    if (isNaN(qtdValor) || qtdValor <= 0) {
        valid = false;
        quantidade.classList.add('is-invalid');
    } else {
        quantidade.classList.remove('is-invalid');
    }

    if (!valid) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('was-validated');
    }
});
