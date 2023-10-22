function validaFormulario() {
    // Obter os valores dos campos
    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var telefone = document.getElementById("telefone").value;
    var esportePreferido = document.getElementById("esporte_preferido").value;
    var corPreferida = document.querySelectorAll('input[name="cor_preferida[]"]:checked');
  
    //Validar se os campos foram preechidos
    if (nome.length == '' || email.length == '' || telefone.length == '' || esportePreferido == '' || corPreferida.length == '') {
      alert("Por favor, preencha todos os campos.");
      return false;
    }
    
    //Verifica se contem apenas numeros no telefone
    if (isNaN(telefone)){
      alert("Insira apenas números no campo de telefone");
      return false;
  }

  //Verifica se o telefone apenas 11 caracteres, caso não tiver exiber um alert
  if (telefone.length > 11){
      alert("Insira um número de telefone válido");
      return false
  }
  
    // Se todos os campos estiverem preenchidos corretamente, retorna true para enviar o formulário
    return true;
  }