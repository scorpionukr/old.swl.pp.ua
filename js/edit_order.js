function editOrderModal(orderId)
{
    var email = $('#order' + orderId + ' td:eq(1)').html(); // email заказчика
    var phone = $('#order' + orderId + ' td:eq(2)').html(); // телефон заказчика
    var package = $('#order' + orderId + ' td:eq(3)').html(); // пакет услуг
    var status = $('#order' + orderId + ' td:eq(5)').html(); // статус

    var htmlForm = '<form method="POST" name="editorder" id="edit-order" action="javascript:void(null);" onSubmit="editOrder(\'edit-order\');">';
    htmlForm += '<input type="hidden" name="orderid" value="' + orderId + '" /><br>';
    htmlForm += '<input type="email" class="form-control" name="email" value="' + email + '" placeholder="Email" required /><br>';
    htmlForm += '<input type="text" class="form-control" name="phone" value="' + phone + '" placeholder="Телефон" required /><br>';
    htmlForm += '<input type="text" class="form-control" name="package" value="' + package + '" placeholder="Пакет" required/><br>';
    htmlForm += '<select class="form-control" name="status"><option value="new">Новый</option><option value="inwork">В работе</option><option value="noaccept">Не выполнен</option><option value="complete">Выполнен</option></select><br>';
    htmlForm += '<button type="submit" name="edit" class="btn btn-success btn-block">Редактировать</button>';
    htmlForm += '</form>';
    htmlForm += '</center>';
    $('#admin-modal-title').html('Редактирование заказа'); // назначаем заголовок модалки
    $('#admin-modal-body').html(htmlForm); // генерим форму
    $('#admin-modal').modal('show'); // выводим всю модалку
}
function editOrder(idForm)
{
    var orderId = $('#' + idForm + ' input[name=orderid]').val();
    var email = $('#' + idForm + ' input[name=email]').val();
    var phone = $('#' + idForm + ' input[name=phone]').val();
    var package = $('#' + idForm + ' select[name=package]').val();
    var status = $('#' + idForm + ' select[name=status]').val();
    if (status == "new")
    {
	status = "Новый";
    }
    if (status == "inwork")
    {
	status = "В работе";
    }
    if (status == "noaccept")
    {
	status = "Не выполнен";
    }
    if (status == "complete")
    {
	status = "Выполнен";
    }
    // выводим изменения в таблицу юзеров
    $('#order' + orderId + ' td:eq(1)').html(email);
    $('#order' + orderId + ' td:eq(2)').html(phone);
    $('#order' + orderId + ' td:eq(3)').html(package);
    $('#order' + orderId + ' td:eq(5)').html(status);
    // сериалайзим форму
    var msg = $('#' + idForm).serialize();
    $.ajax({
	type: 'POST',
	url: 'http://swl.pp.ua/admin/edit_order.php',
	data: msg,
	success: function (data) {
	    $('#' + idForm).trigger('reset');
	    $('#admin-modal-body').html(data);
	},
	error: function (xhr, str) {
	    alert('Возникла ошибка: ' + xhr.responseCode);
	}
    });
}
function deleteOrder(idTr, orderId)
{
    $.ajax({
	type: 'POST',
	url: 'http://swl.pp.ua/admin/delete_order.php',
	data: 'orderid=' + orderId,
	success: function (data) {
	    $('#' + idTr).hide('fast');
	},
	error: function (xhr, str) {
	    alert('ошибка: ' + xhr.responseCode);
	}
    });
}
