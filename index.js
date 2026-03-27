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

const entrarTela = () => {
    window.location.href="index.php"
}

const telaOP = () => {
    window.location.href="telaordemdeprodução.htm"
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

const limparLogin = () => {
    document.getElementById("email").value=""
    document.getElementById("senha").value=""
}


const editarOP = (botao) => {

   
    const linha = botao.closest('tr');

    
    const colunas = linha.querySelectorAll('td');

    const codigo    = colunas[0].innerText; // OP001
    const descricao = colunas[1].innerText; // teste1
    const qtd       = colunas[2].innerText; // 100
    const status    = colunas[4].innerText; // Pendente

 
    const novaDescricao = prompt("Editar descrição de " + codigo + ":", descricao);

    
    if (novaDescricao !== null && novaDescricao !== "") {
        colunas[1].innerText = novaDescricao;
        alert("Atualizado com sucesso!");
    }
};

const excluirOP = (botao) => {
    if (confirm("Tem certeza que deseja excluir esta OP?")) {
        botao.closest("tr").remove();
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const botaoSalvar = document.getElementById("salvarOP");

    if (botaoSalvar) {
        botaoSalvar.addEventListener("click", salvarOP);
    } 
})