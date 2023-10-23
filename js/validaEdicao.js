function validaEdicao(){
    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let telefone = document.getElementById("telefone").value;
    let esporte_preferido = document.getElementById("esporte_preferido").value;
    let cor_preferida = document.querySelectorAll('input[name="cor_preferida[]"]:checked');
    let quantity = document.getElementById("quantity");

    quantity.addEventListener("input", function(){
        let value = parseFloat(quantity.value);
    
        if(isNaN(value)){
            quantity.value = 0;
        } else if(value < -1) {
            quantity.value = -1;
        }
    });

    if(nome.length == '' || email.length == ''|| telefone.length == '' || esporte_preferido == '' || cor_preferida == ''){
        alert('Não é possivel deixar os campos em branco')
        return false;
    };

    if (isNaN(telefone)){
        alert("Insira apenas números no campo de telefone");
        return false;
    }

    //Verifica se o telefone 
    if (telefone.length > 11){
        alert("Insira um número de telefone válido");
        return false
    }

    //Verifica se o campo cor prefirada está em branco, caso estiver retorna um alert
    if (cor_preferida.length === 0) {
    alert('Por favor, selecione pelo menos uma cor');
    return false;
    }

    return true;
}