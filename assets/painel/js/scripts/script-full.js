$(function()
{
	$(".tip").livequery(function(e)
	{
		$(this).unbind().tooltip();
	});
	
	$(".tip-left").livequery(function(e)
	{
		$(this).unbind().tooltip({placement:'left'});
	});
	
	$(".tip-bottom").livequery(function(e)
	{
		$(this).unbind().tooltip({placement:'bottom'});
	});

	 //document.getElementById('requisitos').disabled = true;
	 //document.getElementById('bolsa').disabled 		= true;
	 
	 //document.getElementById('cargo').disabled 		= false;
	 //document.getElementById('atribuicao').disabled = false;
	 //document.getElementById('perfil').disabled 	= false;
	 //document.getElementById('salario').disabled 	= false;


	$('.pop').popover({
		title : $(this).data('title'),
		content : $(this).data('content'),
		placement : 'top'
	});


	$('a.info-help-crop').click(function(){
		$.gritter.add({
			title: 'Informações Úteis',
	        text: 'Selecione na imagem maior a parte desejada para recortar.',
	        sticky: true,
	        time: '5000'
		});
		return false;
	});


	$('a.info-help').click(function(){
		$.gritter.add({
			title: 'Informações Úteis',
	        text: 'Defina as opções abaixo e clique em <a>adicionar</a> para selecionar a(s) imagem(ns) em seu computador. <br /> Estas definições poderão ser usadas para filtar resultados nas páginas como notícias ou álbuns. <br />Após isto, clique em <a>Iniciar</a>.',
	        sticky: true,
	        //image: 'http://profile.ak.fbcdn.net/hprofile-ak-snc6/203244_1677040371_1334985872_q.jpg',
	        time: '5000'
		});
		return false;
	});


	$('a.info-help-files').click(function(){
		$.gritter.add({
			title: 'Informações Úteis',
	        text: 'Digite uma <u>data</u> e/ou escolha um <u>módulo</u> abaixo para refinar a lista. Clique em <i class="icon-refresh" style="font-size:15px;"></i> para atualizar a lista.',
	        sticky: true,
	        //image: 'http://profile.ak.fbcdn.net/hprofile-ak-snc6/203244_1677040371_1334985872_q.jpg',
	        time: '5000'
		});
		return false;
	});


	$('.visible-desktop #messages, .visible-desktop #notifications').click(function(e)
	{
		e.preventDefault();
	});


	$(".top-menu #messages").click(function()
	{
		el = $(this);
		$.post(http_base + "/mensagens", function(response)
		{
			el.unbind('click').popover({
				content		:	response,
				title		:	'Notificações',
				html		:	true,
				placement	:	'bottom',
				delay		:	{show: 500, hide: 100}
			}).popover('show');
		});
	});



	$("#marcar").click(function(e)
	{
		$("input#check").each(function()
		{
			$(this).attr("checked", "checked");
		});
	});



	$("#desmarcar").click(function(e)
	{
		$("input#check").each(function()
		{
			$(this).removeAttr("checked");
		});
	});


	if($(".analytics_item").length > 0)
	{
		Morris.Line({
			element: 'linechart',
			data: [
			       {x: '2012-01-01', y: 102},
			       {x: '2012-01-10', y: 172},
			       {x: '2012-01-20', y: 130},
			       {x: '2012-02-01', y: 198},
			       {x: '2012-02-10', y: 256},
			       {x: '2012-02-20', y: 211},
			       {x: '2012-03-01', y: 345},
			       {x: '2012-03-10', y: 456},
			       {x: '2012-03-20', y: 384},
			       {x: '2012-04-01', y: 584},
			       {x: '2012-04-10', y: 172},
			       {x: '2012-04-20', y: 130},
			       {x: '2012-05-01', y: 198},
			       {x: '2012-05-10', y: 256},
			       {x: '2012-05-20', y: 211},
			       {x: '2012-06-01', y: 345},
			       {x: '2012-06-10', y: 456},
			       {x: '2012-06-20', y: 384},
			       {x: '2012-06-01', y: 584}
			],
			xkey: 'x',
			ykeys: ['y'],
			smooth: false,
			lineColors: ['#42C1F7','#B3E6FC'],
			labels: ['Acessos']
		});
	}


	$('.slide_menu_left').click(function()
	{
		if($(".nav-collapse.collapse").hasClass('open_left'))
		{
			sidemenu_close();
		}
		else
		{
			sidemenu_open();
			$('.main_container').bind('click', function()
			{
				sidemenu_close();
			});

			var handler = function()
			{
				sidemenu_close();
			};

			$(window).bind('resize', handler);
		}
	});


	$('.widget-buttons a.collapse').click(function()
	{
		if ($(this).attr('data-collapsed') == 'false')
		{
			$(this).closest('.widget').find('.widget-body').slideUp();
			$(this).attr('data-collapsed', 'true').addClass('widget-hidden');
		}
		else
		{
			$(this).closest('.widget').find('.widget-body').slideDown();
			$(this).attr('data-collapsed', 'false').removeClass('widget-hidden');
		}
	});


	$(document).on("click", "a.pagination", function(e)
	{
		var _this			=	$(this);
		var page			=	_this.attr('page');
		var modulo			=	_this.attr('rel');
		var input_data		=	$(document).find("input#data").val();
		var input_modulos	=	$(document).find("select#modulos").val();

		$.ajax({
			type		:	"POST",
			url			:	http_base + "/" + modulo + "/arquivos",
			data		:	{pagina:page, data:input_data, modulo:input_modulos},
			cache		:	false,
			dataType	:	"json",
			beforeSend : function()
			{
				//gritter_alert("Aguarde um momento", "Pagina: " + page, 2000, 'gritter-light');
				$(document).find('#pagination-button').empty();
				$(document).find('tbody#pagination-arquivos').empty();
			},
			success : function(data)
			{
				if(data)
				{
					var table = null;
					for(var x=1; x < data[1].length; x++)
					{
						table    =	'<tr id="'+data[1][x].id+'" class="trdrag">';
						table  	+=	'<td class="handle"><i class="icon-move"></i></td>';
						table  	+=	'<td><img src="_ups/arquivos/'+data[1][x].folder+'/'+data[1][x].arquivo+'" width="70" /></td>';
						table  	+=	'<td>'+data[1][x].legenda+'</td>';
						//table  	+=	'<td>'+data[x].credito+'</td>';
						table	+=	'</tr>';
						$(document).find('tbody#pagination-arquivos').append(table);
					}
					$(document).find('#pagination-button').html(data[0]);

					$(".trdrag").unbind().draggable({
						appendTo	:	"body",
						helper		:	"clone",
						handle		:	".handle",
					    cursor		:	"move",
						revert		:	"invalid"
					});
				}
			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				gritter_alert("Erro ao paginar", textStatus, 3000);
			}
		});
	});


	$(document).on("click", "a.del", function(e)
	{
		var _this		=	$(this);
		var id			=	_this.attr('id');
		var modulo		=	_this.attr('rel');

		alertify.confirm('Deseja excluir este registro?', function(e)
		{
			if(e)
			{
				$.ajax({
					type		:	"POST",
					url			:	http_base + "/" + modulo + "/del",
					data		:	{id:id},
					cache		:	false,
					dataType	:	"json",
					beforeSend : function()
					{
						//gritter_alert("Aguarde um momento", "Excluindo o registro!", 2000, 'gritter-light');
					},
					success : function(e)
					{
						gritter_alert("Pronto", "Registro excluido com sucesso!", 2500, 'gritter-light');
	
						$(_this).parent().parent('tr').remove();
					},
					error : function(jqXHR, textStatus, errorThrown)
					{
						gritter_alert("Erro ao excluir", textStatus, 3000);
					}
				});
		    }
			else
			{
		    	gritter_alert("Informação", "Exclusão cancelada", 3000);
		    }
		});
	});


	$(document).on("click", "a.del_files", function(e)
	{
		var _this		=	$(this);
		var id			=	_this.attr('id');
		var modulo		=	_this.attr('rel');

		alertify.confirm('Deseja excluir este arquivo?', function(e)
		{
			if(e)
			{
				$.ajax({
					type		:	"POST",
					url			:	http_base + "/" + modulo + "/delete/arquivos",
					data		:	{id:id, modulo:modulo},
					cache		:	false,
					dataType	:	"json",
					beforeSend : function()
					{
						//gritter_alert("Aguarde um momento", "Excluindo o registro!", 2000, 'gritter-light');
					},
					success : function(e)
					{
						console.log('html: ' + e);

						gritter_alert("Pronto", "Registro excluido com sucesso!", 2500, 'gritter-light');

						$(_this).parent().parent('tr').remove();
					},
					error : function(jqXHR, textStatus, errorThrown)
					{
						gritter_alert("Erro ao excluir", textStatus, 3000);
					}
				});
		    }
			else
			{
		    	gritter_alert("Informação", "Exclusão cancelada", 3000);
		    }
		});
	});


	$(document).on("click", "a.status", function(e)
	{
		var _this		=	$(this);
		var id			=	_this.attr('id');
		var modulo		=	_this.attr('rel');

		$.ajax({
			type		:	"POST",
			url			:	http_base + "/" + modulo + "/status",
			data		:	{id:id},
			cache		:	false,
			dataType	:	"json",
			beforeSend : function()
			{
				//gritter_alert("Aguarde um momento", "Atualizando o registro!", 2000, 'gritter-light');
			},
			success : function(e)
			{
				gritter_alert("Pronto", "Registro atualizado com sucesso!", 2500, 'gritter-light');

				$(_this).attr("data-original-title", e.msg);

				$(_this).find("img").attr("src", "assets/painel/img/icons/dark/" + e.img + ".png");
			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				gritter_alert("Erro ao excluir", textStatus, 3000);
			}
		});
	});


	$(document).on("click", "a.destaque", function(e)
	{
		var _this		=	$(this);
		var id			=	_this.attr('id');
		var modulo		=	_this.attr('rel');

		$.ajax({
			type		:	"POST",
			url			:	http_base + "/" + modulo + "/destaque",
			data		:	{id:id},
			cache		:	false,
			dataType	:	"json",
			beforeSend : function()
			{
				//gritter_alert("Aguarde um momento", "Atualizando o registro!", 2000, 'gritter-light');
			},
			success : function(e)
			{
				gritter_alert("Pronto", "Registro atualizado com sucesso!", 2500, 'gritter-light');

				$(_this).attr("data-original-title", e.msg);

				$(_this).find("img").attr("src", "assets/painel/img/icons/dark/" + e.img + ".png");
			},
			error : function(jqXHR, textStatus, errorThrown)
			{
				gritter_alert("Erro ao excluir", textStatus, 3000);
			}
		});
	});

	
	$(".trdrag").draggable({
		appendTo	:	"body",
		helper		:	"clone",
		handle		:	".handle",
	    cursor		:	"move",
		revert		:	"invalid",
		drag		:	function(event, ui)
		{
			//ui.helper.find("td.action").remove();
		}
	});


	$("#trdropsort").droppable({
		activeClass	:	"ui-state-highlight",
		hoverClass	:	"ui-state-active",
		accept		:	":not(.ui-sortable-helper)",
		drop		:	function(event, ui)
		{
			var _this 		= $(this);
			var uiDrag		=	ui.draggable;
			var uiHtml		=	uiDrag.html();
			var arquivo_id	=	uiDrag.attr('id');
			var id			=	$(this).attr('rel');
			var modelo		=	$(this).attr('model');

			$.ajax({
	    		type		:	"POST",
	    		url			:	http_base + "/" + modelo + "/dragdrop",
	        	data		:	{arquivo_id:arquivo_id, id:id},
	    		cache		:	false,
	    		dataType	:	"json",
	    		beforeSend	:	function(e)
	    		{
	    			//$("div.widget-header .widget-buttons").find("img.img-status2").attr("src", http_base + "/../assets/painel/img/loading/3.gif");
	    		},
	    		success		:	function(e)
	    		{
	    			var div_action = "";

	    			div_action	+=	'<td class="action">';
	    			div_action	+=	'<a rel="'+modelo+'" class="btn btn-mini tip del_files" id="'+e.id+'" href="javascript:void(0);" data-original-title="Excluir">';
	    			div_action	+=	'<img alt="" src="'+http_base+'/../assets/painel/img/icons/dark/trashcan.png"></a>';
	    			div_action	+=	'</td>';

	    			$("<tr id='"+e.id+"'></tr>").html(uiHtml + div_action).appendTo(_this).find("td.handle").remove();
	    		},
	    		error		:	function(jqXHR, textStatus, errorThrown)
	    		{
	    			gritter_alert("Erro no processamento!", textStatus, 1000);
	    		}
	    	});
		}
	});

	$("a.prettyphoto").prettyPhoto({
		animation_speed:	'fast',
    	slideshow:			10000,
    	hideflash:			true,
    	show_title:			true,
    	deeplinking:		false,
    	keyboard_shortcuts:	false
	});

});


function sidemenu_close()
{
	$(".main_container").stop().animate({
		'left' : '0'
	}, 250, 'swing');

	$(".nav-collapse.collapse").stop().animate({
		'left' : '-150px'
	}, 250, 'swing').removeClass('open_left');

	$('.main_container').unbind('click');

	if (typeof handler != 'undefined')
	{
		$(window).unbind('resize', handler);
	}
}


function sidemenu_open()
{
	$(".main_container").stop().animate({
		'left' : '150px'
	}, 250, 'swing');

	$(".nav-collapse.collapse").stop().animate({
		'left' : '0'
	}, 250, 'swing').addClass('open_left');
}


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
    					url			:	http_base + "/modal/" + f + "/" + modulo,
    					data		:	{id:id, mod:modulo},
    					cache		:	false,
    					dataType	:	"html",
    					beforeSend : function()
    					{
    						_data.find('.widget-header h5').html('Editar registros');
    						_data.find('#content-body .widget-body').html('Carregando...');
    						_data.show();
    					},
    					success : function(e)
    					{
   							_data.find('#content-body .widget-body').html(e).slideDown('slow');

    					},
    					error : function(jqXHR, textStatus, errorThrown)
    					{
    						_data.find('#content-body .widget-body').show('pulsate', 3000).html('Processo não concluido. Tente mais tarde!');
    					}
    				});
                });
            });
        },
        onClose: function (dialog)
        {
        	dialog.container.slideUp('slow', function()
        	{
        		$.modal.close();
        		window.location.href = http_base + "/apps/#/" + modulo;
        	});
        },
        overlayClose:false
    });
}