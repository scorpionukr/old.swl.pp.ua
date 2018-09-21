function tryLogin(idForm)
{
	var msg = $('#'+idForm).serialize();
    $.ajax({
		type: 'POST',
  		url: 'http://swl.pp.ua/admin/trylogin.php',
     	data: msg,
     	success: function(data) {
            $('#'+idForm).trigger('reset');
    	},
     	error:  function(xhr, str){
     		alert('Возникла ошибка: ' + xhr.responseCode);
     	}
	});
}
