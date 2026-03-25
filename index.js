const voltarLogin = () => {
    window.location.href = "login.htm"
}

const logar = () => {
    window.location.href = "telaTop.htm"
}
const sairtop = () => {
    window.location.href = "login.htm"
}


const botao = document.getElementById("btsalvar");
if (botao) {
    botao.addEventListener("click", function() {
        const toastEl = document.getElementById("notificacao");
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });
}


