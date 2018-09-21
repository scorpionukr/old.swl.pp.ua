function showHide(idDiv, classDiv)
{
	$('.'+classDiv).hide('fast');
	$('#'+idDiv).show('fast');
}
function showHideClass(classDiv1, classDiv2)
{
	$('.'+classDiv2).hide('fast');
	$('.'+classDiv1).show('fast');
}
function showAll(classDiv)
{
	$('.'+classDiv).show('fast');
}
function toggleClass(classDiv1, classDiv2)
{
	$('.'+classDiv2).toggle('fast');
	$('.'+classDiv1).toggle('fast');
}
