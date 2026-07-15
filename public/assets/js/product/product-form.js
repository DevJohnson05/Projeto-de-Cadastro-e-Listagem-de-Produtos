function validateProductForm(form, options) {
    options = options || {};
    const requireDate = options.requireDate !== false;
    let valid = true;

    const fields = {
        nome: form.querySelector('#nome'),
        cod_produto: form.querySelector('#cod_produto'),
        quantidade: form.querySelector('#quantidade'),
        data_valid: form.querySelector('#data_valid'),
    };

    if (!fields.nome.value.trim() || fields.nome.value.trim().length < 3) {
        valid = false;
        fields.nome.classList.add('is-invalid');
    } else {
        fields.nome.classList.remove('is-invalid');
    }

    if (!fields.cod_produto.value.trim() || fields.cod_produto.value.trim().length < 2) {
        valid = false;
        fields.cod_produto.classList.add('is-invalid');
    } else {
        fields.cod_produto.classList.remove('is-invalid');
    }

    const qtd = parseFloat(fields.quantidade.value);
    if (isNaN(qtd) || qtd <= 0) {
        valid = false;
        fields.quantidade.classList.add('is-invalid');
    } else {
        fields.quantidade.classList.remove('is-invalid');
    }

    if (requireDate && !fields.data_valid.value) {
        valid = false;
        fields.data_valid.classList.add('is-invalid');
    } else if (fields.data_valid.value) {
        const dataValor = new Date(fields.data_valid.value + 'T12:00:00');
        const hoje = new Date();
        hoje.setHours(0, 0, 0, 0);
        if (dataValor < hoje) {
            valid = false;
            fields.data_valid.classList.add('is-invalid');
        } else {
            fields.data_valid.classList.remove('is-invalid');
        }
    } else {
        fields.data_valid.classList.remove('is-invalid');
    }

    if (!valid) {
        form.classList.add('was-validated');
    }

    return valid;
}
