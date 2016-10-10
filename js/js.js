function menuView() {
    var x = document.getElementById('menuList');
    if (x.style.display === 'none') {
        x.style.display = 'initial';
    } else {
        x.style.display = 'none';
    }
}

var action_cod

function concluir(action_cod){
	    $('#link').click(function(){
		$.ajax({
        type: "GET",
        url: "actions.php",
        data: { concluir: action_cod)}})
}}
  
  function cancelar(action_cod){
      $.ajax({
        type: "POST",
        url: "actions.php",
        data: { cancelar: $("select[cancelar='action_cod']").val()},
       });
  }
  
  function newAction(){
	  if(document.getElementById('insertpa').style.display == 'block'{
		  document.getElementById('insertpa').style.display = 'none';
	  } else if(document.getElementById('filterpa').style.display == 'block') {
			document.getElementById('filterpa').style.display = 'none';
			document.getElementById('insertpa').style.display = 'block';
	  } else {
			document.getElementById('insertpa').style.display = 'block';
	  }
  } 
  
  function filterAction(){
	  if(document.getElementById('filterpa').style.display == 'block'{
		  document.getElementById('filterpa').style.display = 'none';
	  } else if(document.getElementById('insertpa').style.display == 'block') {
			document.getElementById('insertpa').style.display = 'none';
			document.getElementById('filterpa').style.display = 'block';
	  } else {
			document.getElementById('filterpa').style.display = 'block';
	  }
  }
  
  
  function validar(){
		var  company_name = register.company_name.value;
		var  company_address = register.company_address.value;
		var  company_city = register.company_city.value;
		var  company_state = register.company_state.value;
		var  company_country = register.company_country.value;
		var  company_zipcode = register.company_zipcode.value;
		var  user_email = register.user_email.value;
		var  user_password = register.user_password.value;
		var  reptuser_password = register.reptuser_password.value;
		var  user_name = register.user_name.value;
		
		If (company_name ==""){
			alert("Por favor, preencha o campo com o nome da empresa!");
			register.company_name.focus();
			return false;
		}
		
		If (company_address ==""){
			alert("Por favor, preencha o campo com o endere&ccedil;o da empresa!");
			register.company_address.focus();
			return false;
		}
		
		If (company_city ==""){
			alert("Por favor, preencha o campo com a cidade da empresa!");
			register.company_city.focus();
			return false;
		}
		
		If (company_state ==""){
			alert("Por favor, preencha o campo com o Estado da empresa!");
			register.company_state.focus();
			return false;
		}
		
		If (company_country ==""){
			alert("Por favor, preencha o campo com o Pa&iacute;s da empresa!");
			register.company_country.focus();
			return false;
		}
		
		If (company_zipcode ==""){
			alert("Por favor, preencha o campo com o CEP da empresa!");
			register.company_zipcode.focus();
			return false;
		}
		
		If (user_email ==""){
			alert("Por favor, preencha o campo com o seu email!");
			register.user_email.focus();
			return false;
		}
		
		If (user_password ==""){
			alert("Por favor, preencha o campo com sua senha!");
			register.user_password.focus();
			return false;
		}
		
		If (user_password.length <6){
			alert("A senha deve ter mais do que 6 caracteres!");
			register.user_password.focus();
			return false;
		}
		
		If (user_password != reptuser_password){
			alert("As senhas digitadas n&atilde;o coincidem!");
			register.user_password.focus();
			return false;
		}
		
	  
	  
  }