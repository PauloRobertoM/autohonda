var http_base = $("base").attr('href');

$(document).ready(function()
{
	$(".tips, .tips-right, .tips-left, .tips-bottom").livequery(function(e)
	{
		$('.tips').unbind().tipsy({gravity: 's',html: true});
		$('.tips-right').unbind().tipsy({gravity: 'w',html: true});
		$('.tips-left').unbind().tipsy({gravity: 'e',html: true});
		$('.tips-bottom').unbind().tipsy({gravity: 'n',html: true});
	});


	$("ul#middlelist li:odd").addClass("odd");



	$(document).on("click", ".toggle-message .title, .toggle-message p", function(e)
	{
		$(this).parents(".toggle-message").find(".hide-message").slideToggle();
		return false;
	});



	$(document).on("click", ".toggle", function(e)
	{
		$($(this).attr('rel')).toggle().toggleClass('oculto');
		return false;
	});



	$(document).on("click", "#profilebox, #profilemenu2 .close", function(e)
	{
		$(".profilemenu2").slideToggle();
	});



	$(document).on("click", "#open-stats, #stats .close", function(e)
	{
		$("#stats").slideToggle();
	});



	$(document).on("click", "#marcar", function(e)
	{
		$("input#check").each(function()
		{
			$(this).attr("checked", "checked");
		});
	});



	$(document).on("click", "#desmarcar", function(e)
	{
		$("input#check").each(function()
		{
			$(this).removeAttr("checked");
		});
	});



	$(document).on("click", ".subtitle .action", function(e)
	{
		$(this).parents(".subtitle").find(".submenu").slideToggle();
		return false;
	});



	$(document).on("click", ".ver_comments", function(e)
	{
		$('div#comments_id_' + $(this).attr('id')).slideToggle();
		return false;
	});



	$("ul#middlelist").sortable(
	{
        placeholder: "ui-state-highlight",
        handle: "span.ui-icon",
        cursor: "move",
        update : function()
        {
        	var order		=	$(this).sortable('serialize');
        	var modulo		=	window.location.hash.substring(2);

    		$.ajax({
    			type		:	"POST",
    			url			:	http_base + "/sortable_item/" + modulo,
        		data		:	order,
    			cache		:	false,
    			beforeSend : function()
    			{
    				f_alert('Enviando ordenação!', 2000);
    			},
    			success : function(e)
    			{
    				f_alert('Ordenação gravada com sucesso!', 2000);
    			},
    			error : function(jqXHR, textStatus, errorThrown)
    			{
    				$("div#error").show().find("p").html(textStatus);
    			},
    			complete : function(e)
    			{
					$("ul#middlelist li").removeClass("odd");
					$("ul#middlelist").find("li:odd").addClass("odd");
    			}
    		});
        }
    });



	$(document).on("click", "a.del", function(e)
	{
		if(confirm("Deseja excluir este registro?"))
		{
			var _this		=	$(this);
			var id			=	_this.attr('id');
			var comments	=	($(this).attr("type") == "comments") ? true : false ;
			var modulo		=	window.location.hash.substring(2);
			var id_arr		=	new Array();

			$('div.paged_content:visible').find('ul#middlelist li').each(function(index, value){
				id_arr.push($(this).attr('id'));
			});

			$.ajax({
				type		:	"POST",
				url			:	http_base + "/del/" + modulo,
				data		:	"id=" + id,
				cache		:	false,
				dataType	:	"json",
				beforeSend : function()
				{
					$("div#loading").show();
				},
				success : function(e)
				{
					f_alert('Registro excluido com sucesso!', 2000);

					$(_this).parent("div").parent('li').remove();

					if(comments == false)
					{
						total_reg_menu = $("ul.submenu").find("li." + modulo).find('a span').html();
						total_reg_menu = parseInt(total_reg_menu-1);
						$("ul.submenu").find("li." + modulo).find('a span').html(total_reg_menu);
					}
				},
				error : function(jqXHR, textStatus, errorThrown)
				{
					$("div#error").show().find("p").html(textStatus);
				},
				complete : function(e)
				{
					$("div#loading").hide();

					if(comments == false)
					{
						var _thisReg	=	$(".body:visible").find("ul#middlelist");
						var idReg		=	_thisReg.find("li:last").find("div").find("a").attr('id');
						var pageReg		=	_thisReg.find("li:last").find("div").find("a").attr('page');
						var orderReg	=	_thisReg.find("li:last").find("div").find("a").attr('order');

						$.post(http_base + "/insert_item/" + modulo, {id:idReg, idnot:id_arr}, function(dados)
						{
							if(dados.length)
							{
								f_alert('Registro excluido e um outro registro foi adicionado na lista...', 2000);
							}

							$(_thisReg).append(dados, function(index, dados)
							{
								return $(this);
							});

							$("ul#middlelist li").removeClass("odd");
							$("ul#middlelist").find("li:odd").addClass("odd");
						});
					}
				}
			});
	    }
		else
		{
	    	f_alert('Exclusão não executada!', 5000);
	    }
	});



	$(document).on("click", "a.status", function(e)
	{
		var _this		=	$(this);
		var id			=	_this.attr('id');
		var modulo		=	window.location.hash.substring(2);

		$.ajax({
			type		:	"POST",
			url			:	http_base + "/status_item/" + modulo,
			data		:	"id=" + id,
			cache		:	false,
			beforeSend : function()
			{
				$("div#loading").show();
			},
			success : function(img_retorno)
			{
				f_alert('Registro atualizado com sucesso!', 2000);

				var unitTitleReg	=	($(_this).attr("original-title") == "Desativar registro") ? 1 : 0;
				var titleReg		=	(unitTitleReg == 1) ? 'Ativar registro' : 'Desativar registro' ;

				$(_this).attr("title", titleReg);

				$(_this).find("img").attr("src", "assets/painel/img/icons/dark/" + img_retorno + ".png");
			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				$("div#error").show().find("p").html(textStatus);
			},
			complete : function(e)
			{
				$("div#loading").hide();
			}
		});
	});



	$("#slider-range-max").livequery(function(e)
	{
		$(this).slider({
	        range: "max",
	        min: 5,
	        max: 30,
	        value: $("#amount-range-max").attr('rel'),
	        slide: function(event, ui)
	        {
	            $("#amount-range-max").val(ui.value);
	        }
	    });
	});



	$(".tags").livequery(function(e)
	{
		$(this).tagsInput({
			width:'80%'
		});
	});

	

	$(document).on("submit", "form#frm_config", function(e)
	{
		$(this).validate({
			errorElement: "div",
			rules: {
				nome: {required: true},
				login: {required: true},
				email: {required: true, email:true},
			}, 
			messages: {
				nome: {"required": "Campo obrigatório"},
				login: {"required": "Campo obrigatório"},
				email: {"required": "Campo obrigatório", "email": "Digite um e-mail válido"},
			},
			submitHandler: function(form)
			{
				$.ajax({
					type		:	"POST",
					url			:	http_base + "/config",
					data		:	$(form).serialize(),
					cache		:	false,
					beforeSend : function()
					{
						$("div#loading").show();
					},
					success : function(e)
					{
						f_alert('Dados atualizado!', 2000);
					},
					error : function(jqXHR, textStatus, errorThrown)
					{
						$("div#error").show().find("p").html(textStatus);
					},
					complete : function(e)
					{
						$("div#loading").hide();
					}
				});
			}
		});
	});

});


function f_alert(info, time)
{
	var _time = 0;
	_time = (time == null) ? 3000 : time ;

	$("#info_page").find('span').find('p').empty();

	$("#info_page")
		.stop(true, true)
		.clearQueue()
		.slideDown("normal", function(e) {
			clearTimeout($(this).data('timeout'));

			$(this)
				.find('span')
				.find("p")
				.empty()
				.html(info);

			var t = setTimeout(function(d)
			{
				$("#info_page").slideUp();
		    }, _time);

			$(this).data('timeout', t);
	});
}


function form_modal(modulo, id, extra)
{
	var f = (extra == null) ? 'form' : extra ;

	$("div#form-modal").modal({
        containerCss:{
            height	:	"80%",
            width	:	980
        },
        onOpen: function (dialog)
        {
            dialog.overlay.fadeIn('fast', function()
            {
                dialog.data.hide();
                dialog.container.fadeIn('slow', function()
                {
                	var _data = dialog.data;
                	$.ajax({
    					type		:	"POST",
    					url			:	http_base + "/" + f + "/" + modulo,
    					data		:	"id=" + id + "&mod=" + modulo,
    					cache		:	false,
    					dataType	:	"html",
    					beforeSend : function()
    					{
    						_data.find('.titleh h3').html('Mais novo registro ainda');
    						_data.find('#content-body .body').html('Carregando...');
    						_data.show();
    					},
    					success : function(e)
    					{
   							_data.find('#content-body .body').html(e).slideDown('slow');

    					},
    					error : function(jqXHR, textStatus, errorThrown)
    					{
    						_data.find('#content-body .body').show('pulsate', 3000).html('Processo não concluido. Tente mais tarde!');
    					}
    				});
                });
            });
        },
        onClose: function (dialog) {
        	dialog.container.slideUp('slow', function () {
        		$.modal.close();
        	});
        },
        overlayClose:true
    });
}


function modal_error(sleep)
{
	$("div#error").modal({
        containerCss:{
            height	:	400,
            width	:	200
        },
        overlayClose:true
    });

	if(sleep != "")
	{
		setTimeout(function()
		{
			window.location.href = $("base").attr("href") + "/apps/#/home";
		}, sleep);
	}
}


function modal_content_error(info, wi, he)
{
	$("#info_page").hide();

	var $_wi = (wi == "") ? "400" : wi ;
	var $_he = (he == "") ? "200" : he ;

	$("div#modal-error").find('p').html('');
	$("div#modal-error").find('p').html(info);

	$("div#modal-error").modal({
        containerCss:{
            height	:	$_he,
            width	:	$_wi
        },
        overlayClose:true
    });
}


function modal_content(modulo, id, extra, width, height)
{
	var $_w = (width == "") ? "500" : width ;
	var $_h = (height == "") ? "600" : height ;

    $.modal('<iframe src="painel/modal/' + modulo + '/' + id + '/' + extra + '" height="' + $_h + '" width="' + $_w + '" style="border:0">', {
        closeHTML	:	'<a class="modalCloseImg simplemodal-close shortcut" title="Fechar"><img src="assets/painel/img/icons/dark/cross.png" border="0" /></a>',
        containerCss:{
            backgroundColor	:	"#fff",
            borderColor		:	"#fff",
            height			:	$_h,
            padding			:	0,
            width			:	$_w,
            zIndex			:	10000
        },
        onOpen: function (dialog) {
            dialog.overlay.fadeIn('slow', function () {
                dialog.data.hide();
                dialog.container.fadeIn('slow', function () {
                    dialog.data.slideDown('slow');
                });
            });
        },
        onClose: function (dialog) {
            dialog.data.fadeOut('slow', function () {
                dialog.container.hide('slow', function () {
                    $.modal.close();
                    maximizeFormHelper();
                });
            });
        },
        overlayClose:false
    });
}


function IsNumeric(value)
{
	if(value.length > 0)
	{
		var er = /^[0-9]+$/;
		return (er.test(value)) ? true : false;
	}
	else
	{
		return false;
	}
}
