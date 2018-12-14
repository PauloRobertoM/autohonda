var http_base = $("base").attr("href");
var rel_base = $("base").attr("rel");

$(document).ready(function()
{
	$(".datahora").mask("99/99/9999 99:99:99");
		
	$(".data").mask("99/99/9999");

	$(".datepicker").datepicker("show");
	//$(this).mask("99/99/9999");

	$(".datetimepicker").datetimepicker("show");
	//$(this).mask("99/99/9999 99:99:99");

	$(".monetario").maskMoney({
        symbol		:	"R$",
        decimal		:	",",
        thousands	:	"."
    });


	$('.tags').tagsInput({width:'80%'});


	$(".uniform").uniform();


	$("div.get-photos").sortable({
        placeholder: "ui-state-highlight-photos",
        handle: "span.ui-icon",
        cursor: "move",
        update : function () {
        	var order		=	$(this).sortable('serialize');
        	var modulo		=	window.location.hash.substring(2);

    		$.ajax({
    			type		:	"POST",
    			url			:	http_base + "/sortable_files/" + modulo,
        		data		:	order,
    			cache		:	false,
    			beforeSend : function()
    			{
    				f_alert('Enviando posicionamento...', 2000);
    			},
    			success : function(e)
    			{
    				f_alert('Posição atualizada!', 2000);
    			},
    			error : function(jqXHR, textStatus, errorThrown)
    			{
    				$("div#error").show().find("p").html(textStatus);
    			}
    		});
        }
    });


	$(document).on("click", "a.form-helper-open-album", function(e)
	{
		var $_rel = $(this).attr("rel");
		var $_id = $(this).attr("id");

		if($_rel != "")
		{
			$.post(http_base + "/fotos/" + $_rel, {id_post:$_id}, function(html)
			{
				$("div#div-content-form-helper")
					.css({"height":"550px", "width":"620px", "right":"620px", "position":"absolute", "z-index":"99999"})
					.show()
					.find(".body")
					.html(html);

				$("#iduploadify").livequery(function(e)
				{
					$("#file_upload").uploadify({
						'uploadLimit'		:	20,
						'width'				:	90,
						'height'			:	34,
						'removeCompleted'	:	true,
						'requeueErrors'		:	false,
						'multi'				:	true,
						'debug'				:	false,
						'auto'				:	false,
						'fileSizeLimit'		:	'4MB',
						'fileTypeExts'		:	'*.gif; *.jpg; *.png; *.doc; *.docx; *.xls; *.pdf; *.txt',
						'queueID'			:	'listaArquivos',
						'method'			:	'POST',
						'formData'      	:	{'id':$_id, 'modulo':$_rel, 'resize':false},
					    'uploader'			:	http_base + '/uploader',
					    'buttonText'		:	"Selecione",
						'buttonImage'		:	rel_base + 'assets/painel/img/icons/button/search.png',
					    'swf'				:	rel_base + 'assets/painel/js/uploadify/uploadify.swf',
						'onInit'			:	function(e)
						{
							$("div#file_upload").addClass('icon-button-uploadify');
						},
						'onUploadStart'		:	function(file)
						{
					    	var type_val = $('#resize').is(":checked");
						    $('#enviarArquivos').uploadify("settings", "formData", {'resize' : type_val});
						},
						'onUploadError' : function(file, errorCode, errorMsg, errorString)
						{
							//console.log('Error: The file ' + file.name + ' could not be uploaded: ' + errorString + ' | ' + errorMsg);
					    },
					    'onUploadComplete' : function(file)
					    {
					        //console.log('The file ' + file.name + ' finished processing.');
					    },
						'onUploadSuccess'	:	function(file, data, response)
						{
							var data_return = eval('('+data+')');

							if(data_return.status == 2)
							{
								f_alert(data_return.error, 3000);
							}
							else
							{
								var div = '';
								div +=	'<div class="get-photo" id="i_' + data_return.id_file + '">';
								div +=		'<span class="ui-icon ui-icon-arrow-4 ui-state-default tips-right" style="margin-left:0; margin-top:6px; margin-left:6px; position:absolute; cursor:move;" title="Arraste para organizar"></span>';
								div += 		'<div class="buttons">';
								div += 			'<a href="javascript:void(0);" rel="' + data_return.folder + '" id="' + data_return.id_file + '" class="mini-edit">Editar</a>';
								div += 			'<a href="javascript:void(0);" rel="' + data_return.folder + '" id="' + data_return.id_file + '" class="mini-delete">Deletar</a>';
								div += 			'<div class="clear"></div>';
								div += 		'</div>';
								div += 		'<a href="' + rel_base + '_up/' + $_rel + '/' + data_return.new_name + '" rel="prettyPhoto">';
								div +=			'<img src="' + rel_base + '_up/' + $_rel + '/' + data_return.new_name+ '" width="146" height="110" />';
								div += 		'</a>';
								div +=	'</div>';
								$('div.get-photos').append(div).show('slow');
							}
						}
					});
				});
			});
		}
	});



	$(document).on("click", "a.form-helper-open-video", function(e)
	{
		if($(this).parent().find("input").val() != "")
		{
			$.ajax({
				type		:	"POST",
				url			:	http_base + "/video/" + $(this).attr("rel"),
				dataType	:	"html",
				data		:	"link=" + $(this).parent().find("input").val(),
				cache		:	true,
				beforeSend	:	function()
				{
					$("div#loading").show();
				},
				success		:	function(data)
				{
					$("div#div-content-form-helper")
						.css({"height":"410px", "width":"500px", "right":"620px", "position":"absolute", "z-index":"99999"})
						.show()
						.find(".body")
						.html(data);
				},
				error		:	function(jqXHR, textStatus, errorThrown)
				{
					$("div#error").show().find("p").html(textStatus);
				},
				complete	:	function(e)
				{
					$("div#loading").hide();
				}
			});
		}
	});



	$(document).on("click", "input#button_action", function(e)
	{
		var modulo		=	$(this).attr("rel");
		var id_item		=	null;
		var form		=	$("form#form_" + modulo);
		var action		=	null;
		var acao		=	null;

		if(modulo == "modulos")
		{
			action		=	(form.find("input[name='acao']").val() == 'new') ? 'add_modulo' : 'upd_modulo' ;
			acao		=	(form.find("input[name='acao']").val() == 'new') ? 'add' : 'upd' ;
		}
		else if(modulo == "grupos")
		{
			action		=	(form.find("input[name='acao']").val() == 'new') ? 'add_grupo' : 'upd_grupo' ;
			acao		=	(form.find("input[name='acao']").val() == 'new') ? 'add' : 'upd' ;
		}
		else if(modulo == "usuarios")
		{
			action		=	(form.find("input[name='acao']").val() == 'new') ? 'add_usuarios' : 'upd_usuarios' ;
			acao		=	(form.find("input[name='acao']").val() == 'new') ? 'add' : 'upd' ;
		}
		else
		{
			action		=	(form.find("input[name='acao']").val() == 'new') ? 'add' : 'upd' ;
			acao		=	(form.find("input[name='acao']").val() == 'new') ? 'add' : 'upd' ;

			var _cke = $(document).find("span.cke_skin_kama");
			if(_cke.size() >= 1)
			{
				var CkEditorGetID	=	_cke.attr('id').split('cke_');
				document.getElementById(getInstanceCkeditor(CkEditorGetID)).value = CKEDITOR.instances[getInstanceCkeditor(CkEditorGetID)].getData();
			}
		}

		$.ajax({
			type		:	"POST",
			url			:	http_base + "/" + action + "/" + modulo,
			data		:	form.serialize(),
			cache		:	false,
			beforeSend : function()
			{
				f_alert('Enviando...', 10000);
			},
			success : function(e)
			{
				f_alert('Gravado!', 2000);
				id_item = e;
			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				f_alert('Erro na gravação! Tente novamente.');
			},
			complete : function(c)
			{
				var _thisRegs	=	$(".body:visible").find("ul#middlelist");

				if(acao == "add")
				{
					$.post(http_base + "/insert_new_item/" + modulo, {id:id_item}, function(data)
					{
						f_alert('Adicionado o registro na lista...', 2000);

						$(_thisRegs).prepend(data, function(index, data) {
							return $(this);
						});

						$("ul#middlelist li").removeClass("odd");
						$("ul#middlelist").find("li:odd").addClass("odd");
					});
				}
				else
				{
					if(IsNumeric(c.responseText) == true)
					{
						$.post(http_base + "/update_item/" + modulo, {id:id_item}, function(data)
						{
							f_alert('Listagem atualizada...', 2000);

							$("ul#middlelist").find("li#i_" + id_item).html(data);

							$("ul#middlelist li").removeClass("odd");
							$("ul#middlelist").find("li:odd").addClass("odd");
						});
					}
					else
					{
						modal_content_error(c.responseText, 400, 200);
					}
				}
			}
		});
	});



	$(document).on("click", "a.mini-edit", function(e)
	{
		var modulo	=	$(this).attr('rel');
		var id		=	$(this).attr('id');

		modal_content(modulo, id, "img-edit", "950", "600");
	});



	$(document).on("click", "a.mini-delete", function(e)
	{
		if(confirm("Deseja mesmo excluir este arquivo?"))
		{
			var modulo	=	$(this).attr('rel');
			var id		=	$(this).attr('id');

			$.ajax({
				type:		"POST",
				url:		http_base + "/del_files/",
				data:		"modulo=" + modulo + "&id=" + id,
				cache:		false,
				dataType:	"json",
				beforeSend:	function()
				{
					f_alert('Aguarde...', 10000);
				},
				success:	function(html)
				{
					$('#i_' + id).hide('slow');

					f_alert('Removido com sucesso!', 10000);
				},
				error:		function(jqXHR, textStatus, errorThrown)
				{
					f_alert('Erro na remoção! Tente novamente.');
				}
			});
		}
	});



	$(document).on("click", "a.removerCampo", function(e)
	{
		var linha_total = $('div.clone').length;

		if(linha_total > 1)
		{
			$(this).parent().parent().remove();
		}
		else
		{
			$("div#div-content-form").show("shake", 55);
			f_alert('Hum, não foi possivel remover a linha!', 3000);
		}
	});



	$(document).on("click", "input#button_adicionar_campo", function(e)
	{
		novoCampo = $("div.clone:first").clone();
		ultimoCampo = $("div.clone:last").clone();

		novoCampo.find("input[type=text]").val("");
		novoCampo.find("select").removeAttr("selected");
		novoCampo.find("input[type=checkbox]").removeAttr("checked");

		var newID = ultimoCampo.attr("id");
		newID = newID.split("_");
		newID = (parseFloat(newID[1]) + parseFloat(1));

		novoCampo.insertAfter("div.clone:last").attr("id", "i_" + newID);

		novoCampo.find("input, select").each(function(e)
		{
			input = $(this).attr("name");
			input = input.split("[");
			newInput = input[0];
			newInput = newInput + "["+newID+"]";
			$(this).attr({id:newInput, name:newInput});
		});

		$('div#content-body').animate({scrollTop:$(document).height()}, 'slow');
	});



	$(document).on("keydown", "#relacao", function(e)
	{
		$(this).autocomplete({
			width: 200,
			minChars: 2,
			zIndex: 99999,
			noCache: false,
			delimiter: /(,|;)\s*/,
			lookup: 'posts,grupos,lixeira,login,logs,modulos,usuarios'.split(',')
		});
	});



	$(document).on("click", ".cb-enable", function(e)
	{
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});



	$(document).on("click", ".cb-disable", function(e)
	{
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});



	$(".get-photo a[rel^='prettyPhoto']").livequery(function(e)
	{
	    $(this).prettyPhoto({
	    		animation_speed:	'fast',
	        	slideshow:			10000,
	        	hideflash:			true,
	        	show_title:			true,
	        	deeplinking:		false,
	        	keyboard_shortcuts:	false
	    });
	});

});

function getInstanceCkeditor(instance){
	return instance[1];
}