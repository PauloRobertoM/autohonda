(function($, window) {
   jQuery("#telefone").mask("(99) 99999-9999");
   jQuery("#cpf").mask("999.999.999-99");
   jQuery("#nascimento").mask("99/99/9999");
	
   /*var parcelas = ["3 Parcelas", "6 Parcelas", "9 Parcelas", "12 Parcelas", "18 Parcelas", "24 Parcelas", "36 Parcelas", "48 Parcelas", "60 Parcelas"];
	
	jQuery("#veiculos").change(function(){
		
		jQuery('#parcelas').empty();
		
		jQuery.ajax({
                url : 'consulta_planos', 
                type : 'POST', 
                data: 'veiculo=' + jQuery('#veiculos').val(), 
                dataType: 'json', 
                success: function(data){
					for(i = 0; i < (data.length - 1); i++){
						if(data[i] != '0.00000'){
							jQuery("#parcelas").append(new Option((parcelas[i]), (i+1)));
						}
					}
					var url = "https://api.whatsapp.com/send?phone="+data[9];
					$("#whatsapp").removeClass("hidden");
					$("#whatsapp").attr("href",url);
					
                },
				error: function(jqXHR, textStatus, errorThrown) {
			   		console.log(textStatus, errorThrown);
				}
           });
		
   		return false;
		
	});*/
	
	// Formulário 1
	
	jQuery("#nome").focus(function(){
		$("#form-fone").removeClass("hidden");
        $('html, body').animate({
            scrollTop: $('#form-fone').offset().top
        }, 2000);
	});
	
	jQuery("#telefone").focus(function(){
		$("#form-email").removeClass("hidden");
	});
	
	jQuery("#email").focus(function(){
		$("#submit").removeClass("hidden");
	});
	
	jQuery("#ressimular").click(function(){
		$("#active").val("0");
		$("#cpf").addClass("hidden");
		$("#nascimento").addClass("hidden");
	    $("#sub-title").addClass("hidden");
	});
	
	jQuery("#simulacao").submit(function(e) {
		$("#modal-load").css("display", "block");
		if ($("#active").val() == "0")
		{
		jQuery.ajax({
			   type: "POST",
			   url: 'send_simulacao',
			   data: jQuery("#simulacao").serialize(), // serializes the form's elements.
			   dataType: 'json', /* Tipo de transmissão */
			   success: function(data)
			   {
				   $("#modal-load").css("display", "none");
				   $("#parcela-final").empty();
				   $("#parcela-final").append('Parcelas de R$ '+data);
				   $("#cpf").removeClass("hidden");
				   $("#label-cpf").removeClass("hidden");
				   $("#nascimento").removeClass("hidden");
				   $("#label-nascimento").removeClass("hidden");
				   $("#sub-title").removeClass("hidden");
				   $("#ressimular").removeClass("hidden");
				   $("#active").val("1");
				   $("#submit").val("Enviar");
			   },
			   error: function(jqXHR, textStatus, errorThrown) {
			   		console.log(textStatus, errorThrown);
				}
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		
		return false;
		}
		else
			{
			   jQuery.ajax({
			   type: "POST",
			   url: 'send_simulacao',
			   data: jQuery("#simulacao").serialize(), // serializes the form's elements.
			   dataType: 'json', /* Tipo de transmissão */
			   success: function(data)
			   {
				   $("#modal-load").css("display", "none");
				   window.location.replace("obrigado");
			   },
			   error: function(jqXHR, textStatus, errorThrown) {
			   		console.log(textStatus, errorThrown);
				}
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		
		return false;
			}
	});
	
	jQuery("#simulacao-consorcio").submit(function(e) {
		$("#modal-load").css("display", "block");
		if ($("#active").val() == "0")
		{
		jQuery.ajax({
			   type: "POST",
			   url: 'send_consorcio',
			   data: jQuery("#simulacao-consorcio").serialize(), // serializes the form's elements.
			   dataType: 'json', /* Tipo de transmissão */
			   success: function(data)
			   { 
				   console.log(data);
				   $("#modal-load").css("display", "none");
				   $("#parcela-final").empty();
				   $("#parcela-final").append('Parcelas de R$ '+data);
				   $("#cpf").removeClass("hidden");
				   $("#label-cpf").removeClass("hidden");
				   $("#nascimento").removeClass("hidden");
				   $("#label-nascimento").removeClass("hidden");
				   $("#sub-title").removeClass("hidden");
				   $("#ressimular").removeClass("hidden");
				   $("#active").val("1");
				   $("#submit").val("Enviar");
			   },
			   error: function(jqXHR, textStatus, errorThrown) {
			   		console.log(textStatus, errorThrown);
				}
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		
		return false;
		}
		else
			{
			   jQuery.ajax({
			   type: "POST",
			   url: 'send_consorcio',
			   data: jQuery("#simulacao-consorcio").serialize(), // serializes the form's elements.
			   dataType: 'json', /* Tipo de transmissão */
			   success: function(data)
			   {
				   $("#modal-load").css("display", "none");
				   window.location.replace("obrigado");
			   },
			   error: function(jqXHR, textStatus, errorThrown) {
			   		console.log(textStatus, errorThrown);
				}
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		
		return false;
			}
	});
	
   var rangeSlider = function(){
      var slider = $('.range-slider'),
          range = $('.range-slider__range'),
          value = $('.range-slider__value');
        
      slider.each(function(){

        value.each(function(){
          var value = $(this).prev().attr('value');
          $(this).html(value);
        });

        range.on('input', function(){
          $(this).next(value).html(this.value);
        });
      });
    };
    rangeSlider();
})(jQuery, window);

