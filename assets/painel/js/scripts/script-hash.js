var http_base = $("base").attr('href');

$(document).ready(function()
{
	var newCompose 		=	"";
	var newComposeSlash	=	"";

	$.modal.close();
	
	$(document).on("click", "a.hashed", function(e)
	{
        e.preventDefault();
        newLocationHash			=	$(this).attr("href").replace("/", "");
        window.location.href	=	http_base + "/apps/#/" + newLocationHash;
        $("a.accordion-toggle").removeClass("active");
        $(this).addClass("active");
        //console.log(newLocationHash);
        return false;
    });

	$(window).on("hashchange", function(e)
	{
		var newHash = window.location.hash.substring(2);

		newCompose = newHash.split("?");

		if(newCompose.length >= 2)
		{
			newComposeSlash = newCompose[1].split("=");

			if(newComposeSlash[0] == "n") // NEW
			{
				var _thisRegs = $(".body:visible").find("ul#middlelist");

				$.post(http_base + "/add/" + newCompose[0], function(data)
				{
//					$.post(http_base + "/new/" + newCompose[0], {id:data.id}, function(html)
//					{
//						$(_thisRegs).prepend(html, function(index, retorno) {
//							return $(this);
//						});
//
//						$("ul#middlelist li").removeClass("odd");
//						$("ul#middlelist").find("li:odd").addClass("odd");
//					});
//					
//					total_reg_menu = $("ul.submenu").find("li." + newCompose[0]).find('a span').html();
//					total_reg_menu = (parseInt(total_reg_menu)) + (parseInt(1));
//					console.log(total_reg_menu);
//					$("ul.submenu").find("li." + newCompose[0]).find('a span').html(total_reg_menu);

					window.location.href = http_base + "/apps/#/" + newCompose[0] + "?u=" + data.id;
				}, "json");
			}
			else if(newComposeSlash[0] == "u") // UPDATE
			{
//				$("div#form-modal .titleh").find("h3").text("Editar registro");
				idReg = parseInt(newComposeSlash[1]);
				form_modal(newCompose[0], idReg);
			}
			else if(newComposeSlash[0] == "p") // PAGINACAO
			{
				paginacao(newComposeSlash[1], newCompose[0]);
			}
			else if(newComposeSlash[0] == "c") // COMENTARIOS
			{
				$("div#form-modal .titleh").find("h3").text("Comentários");
				idReg = parseInt(newComposeSlash[1]);
				form_modal(newCompose[0], idReg, 'comments');
			}
		}
		else
		{
			/* Fechando o formulario se aberto */
			$.modal.close();
		}



		if(newHash == "apps" || newHash == "")
		{
			window.location.href = http_base + "/apps/#/home";
		}
		else
		{
			$(".paged_content").hide();

			if($("div#" + newHash).length > 0)
			{
				$("div#" + newHash).show();

				$.ajax({
	    			type		:	"POST",
	    			url			:	http_base + "/listagem/" + newHash,
	    			cache		:	true,
	    			beforeSend : function()
	    			{
	    				//gritter_alert("Gerando a listagem", "Só mais um momento por favor!", 2000);
	    			},
	    			success : function(data)
	    			{
	    				$("table#content-" + newHash).find("tbody").html(data);
	    				//gritter_alert("Lista carregada.", "Obrigado por aguardar!", 1500, 'gritter-light');
	    			},
	    			error : function(jqXHR, textStatus, errorThrown)
	    			{
	    				gritter_alert("Error", "Tente novamente mais tarde...", 1000);
	    			}
	    		});
			}
			else
			{
				gritter_alert("Informação Importante", "Módulo Inexistente", 3000);
			}
		}
	});

	$(window).trigger('hashchange');
	
	setClassActived(window.location.hash.substring(2));
});



function paginacao(id, modulo)
{
	var _thisRegs = $(".body:visible").find("ul#middlelist");
	$(_thisRegs).html("Carregando...");

	$.post(http_base + "/pagination/" + modulo, {page:id}, function(html)
	{
		$(_thisRegs).html(html);

		$("ul.pagination li a").removeClass("red");
		$("ul.pagination li").find('a#i_' + id).addClass("red");

		$("ul#middlelist li").removeClass("odd");
		$("ul#middlelist").find("li:odd").addClass("odd");
	});
}



function setClassActived(locator)
{
	if(locator)
	{
		$("div.accordion-body").addClass("in");
		$("div.accordion-body").find("#" + locator).addClass("active");
	}
}