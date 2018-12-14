$(document).ready(function()
{
	$("form#frm-login").submit(function()
	{
		if($('#username').val() != "" && $('#password').val() != "")
		{
			gritter_alert("Aguarde", "Analisando os dados", 3000, 'gritter-light');
			$.ajax({
				type		:	"POST",
				url			:	"autentica",
				data		:	{username:$("#username").val(), password:$('#password').val()},
				dataType	:	"json",
				success		:	function(data)
				{
					if(data.status == 200)
					{
						gritter_alert("Seja Bem-vindo!", "Um momento por favor.", 3000, 'gritter-light');
						setTimeout("window.location.href='home'", 2000);
					}
					else
					{
						gritter_alert("Atenção", "Dados incorretos!", 3000);
					}
				},
				error		:	function(jqXHR, textStatus, errorThrown)
				{
					gritter_alert("Ocorreu um erro!", "Tente mais tarde, por favor!", 3000);
				}
			});
		}
		else
		{
			gritter_alert("Atenção", "Insira os dados de acesso!", 3000);
		}
	});
});



function gritter_alert(titulo, info, time, clas)
{
	var _t = (time == null) ? 3000 : time ;

	$.gritter.add({
		title	:	titulo,
		text	:	info,
		sticky	:	false,
		class_name: clas,
		time	:	_t
	});

	return false;
}