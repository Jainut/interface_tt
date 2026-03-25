const voltarLogin = () => {
    window.location.href = "login.htm"
}

const logar = () => {
    window.location.href = "telaTop.htm"

}

const sairtop = () => {
    window.location.href = "login.htm"
}

const voltarTop = () => {
    window.location.href ="login.htm"     
}




const limparFormularioOP = () => {
    document.getElementById("numOP").value = "";
    document.getElementById("produto").value = "";
    document.getElementById("quantidade").value = "";
    document.getElementById("prazo").value = "";
    document.getElementById("status").value = "";
    document.getElementById("responsavel").value = "";
    document.getElementById("equipamento").value = "";
   
}



const editarOP = (botao) => {
    
}

const excluirOP = (botao) => {
    if (confirm("Tem certeza que deseja excluir esta OP?")) {
        botao.closest("tr").remove
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const botaoSalvar = document.getElementById("salvarOP");
    
    if (botaoSalvar) {
        botaoSalvar.addEventListener("click", salvarOP);
    }
    
})