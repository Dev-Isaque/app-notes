function enviaCadastro() {
    const form = document.getElementById('formCadastro');
    const alerta = document.getElementById('alerta');

    if (form.password_pri.value !== form.password_sec.value) {
        alerta.classList.remove("d-none");
        return;
    }

    form.submit();
}