var http_base = $("base").attr("href");
var rel_base = $("base").attr("rel");

$(document).ready(function()
{
	//$(".datahora").mask("99/99/9999 99:99:99");
	//$(".data").mask("99/99/9999");

	//$("#select2-basic").select2();
	//$("#select2-multi-value").select2();
	//$("#select2-max-value").select2({maximumSelectionSize: 3});
	//$("#select2-tags").select2({tags:["red", "green", "blue"],tokenSeparators: [",", " "]});

	//$('.colorpicker-rgb').colorpicker({ format:'rgb'});
	//$('.colorpicker-rgba').colorpicker({ format:'rgba'});
	//$('.colorpicker-hex').colorpicker({ format:'hex'});

	$("#select2-max-value").select2({maximumSelectionSize: 1});

	$(".datepicker").datepicker();
	//$('#datepicker-years').datepicker({viewMode:2});

	$('.timepicker-12hrs').timepicker();
	$('.timepicker-24hrs').timepicker({showMeridian:false,showInputs:false,showSeconds:true});

	$(".monetario").maskMoney({
        symbol		:	"R$",
        decimal		:	",",
        thousands	:	"."
    });
	
	$(".coeficiente").mask("9.99999");
	
	$(".taxa-adm").mask("99.99");
	
	$(".fundo-res").mask("9.99");
		
	$("#telefone").mask("99(99)99999-9999");

	$('.tags').tagsInput({width:'80%', height:'80px', defaultText:'add uma tag'});

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
});