$(document).ready(function()
{
	var LocationBase = $("base").attr("href");
	var LocationRel = $("base").attr("rel");
	

	$(".datahora").livequery(function(e)
	{
		$(".datahora").mask("99/99/9999 99:99:99");
	});
	
	
	$(".data").livequery(function(e)
	{
		$(".data").mask("99/99/9999");
	});

	
	/* Tipsy */
	$(".tips, .tips-right, .tips-left, .tips-bottom").livequery(function(e)
	{
		$('.tips').tipsy({gravity: 's',html: true});
		$('.tips-right').tipsy({gravity: 'w',html: true});
		$('.tips-left').tipsy({gravity: 'e',html: true});
		$('.tips-bottom').tipsy({gravity: 'n',html: true});
	});


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



	$(".uniform").uniform();



	/* iphone style switches */
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