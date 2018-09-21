function editUserModal(userId)
{
    var login = $('#user' + userId + ' td:eq(1)').html(); // вынимаем логин
    var phone = $('#user' + userId + ' td:eq(2)').html(); // вынимаем телефон
    var status = $('#user' + userId + ' td:eq(3)').html(); // вынимаем статус

    var htmlForm = '<form method="POST" name="edituser" id="edit-user" action="javascript:void(null);" onSubmit="editUser(\'edit-user\');">';
    htmlForm += '<input type="hidden" name="userid" value="' + userId + '" /><br>';
    htmlForm += '<input type="text" class="form-control" name="name" value="' + login + '" placeholder="Логин" required /><br>';
    htmlForm += '<input type="text" class="form-control" name="password" value="" placeholder="Пароль" required /><br>';
    htmlForm += '<input type="text" class="form-control" name="phone" value="' + phone + '" placeholder="Телефон" required/><br>';
    htmlForm += '<select class="form-control" name="enable"><option value="1">Активен</option><option value="0">Неактивен</option></select><br>';
    htmlForm += '<button type="submit" name="edit" class="btn btn-success btn-block">Сохранить</button>';
    htmlForm += '</form>';
    htmlForm += '</center>';
    $('#admin-modal-title').html('Редактирование пользователя'); // назначаем заголовок модалки
    $('#admin-modal-body').html(htmlForm); // генерим форму
    $('#admin-modal').modal('show'); // выводим всю модалку
}
function editUser(idForm)
{
    var userId = $('#' + idForm + ' input[name=userid]').val();
    var name = $('#' + idForm + ' input[name=name]').val();
    var phone = $('#' + idForm + ' input[name=phone]').val();
    var status = $('#' + idForm + ' select[name=enable]').val();
    if (status == 1)
    {
	status = "Активен";
    }
    else
    {
	status = "Неактивен";
    }
    // выводим изменения в таблицу юзеров
    $('#user' + userId + ' td:eq(1)').html(name);
    $('#user' + userId + ' td:eq(2)').html(phone);
    $('#user' + userId + ' td:eq(3)').html(status);
    // сериалайзим форму
    var msg = $('#' + idForm).serialize();
    $.ajax({
	type: 'POST',
	url: 'http://swl.pp.ua/admin/edit_user.php',
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
function deleteUser(idTr, userId)
{
    $.ajax({
	type: 'POST',
	url: 'http://swl.pp.ua/admin/delete_user.php',
	data: 'userid=' + userId,
	success: function (data) {
	    $('#' + idTr).hide('fast');
	},
	error: function (xhr, str) {
	    alert('Возникла ошибка: ' + xhr.responseCode);
	}
    });
}
