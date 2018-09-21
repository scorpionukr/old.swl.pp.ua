function viewModal(idModal, idPackage)
{
	$('#package').val(idPackage);
	$('#'+idModal).modal('show');
}
function sendOrderIndex(idForm, idModal)
{
	var msg = $('#'+idForm).serialize();
    $.ajax({
		type: 'POST',
  		url: 'http://swl.pp.ua/order.php',
     	data: msg,
     	success: function(data) {
            $('#'+idForm).trigger('reset');
            $('#'+idModal).modal('show');
            $('#ret').html(data);
    	},
     	error: function(xhr, str){
            alert('Ошибка отправки данных sendOrderIndex(): ' + xhr.responseCode);
     	}
	});
}
function sendCreateUser(idForm, idModal)
{
	var msg = $('#'+idForm).serialize();
    $.ajax({
		type: 'POST',
  		url: 'https://swl.pp.ua/admin/create_user.php',
     	data: msg,
     	success: function(data) {
            $('#'+idForm).trigger('reset');
            $('#'+idModal).modal('show');
    	},
     	error:  function(xhr, str){
			// $('#admin-modal-body').html(data);
     		alert('Ошибка отправки данных sendCreateUser: ' + xhr.responseCode);
     	}
	});
}
