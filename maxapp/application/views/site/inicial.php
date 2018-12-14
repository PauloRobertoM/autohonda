<?php include 'components/header.php'; ?>
	
	<div id="ancora-final"></div>
	<section class="topo">
		<img src="<?=base_url("assets/site/images/logo.png");?>" alt="" class="logo">
	</section><!-- topo -->
	
	<section class="conteudo inicial">
		<div class="container">
			<div class="titulo-geral">
				<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
				<h2 id="efeitoMaquina1"></h2>
			</div><!-- titulo-geral -->
			<input type="button" value="Consórcio" onclick="location.href='http://localhost:81/www/maxmeio/autohonda/consorcio';" class="botao">
			<input type="button" value="Financiamento" onclick="location.href='http://localhost:81/www/maxmeio/autohonda/financiamento';" class="botao">
		</div><!-- container -->
	</section><!-- conteudo -->

<?php include 'components/footer.php'; ?>

<script>
	var typed = new Typed('#efeitoMaquina1', {
    	strings: ["Escolha Financiamento ou Consórcio"],
    	typeSpeed: 80,
	    startDelay: 800,
	    showCursor: false
    });
    (function($, window) {
    	$('html, body').animate({
            scrollTop: $('#ancora-final').offset().top
        }, 2000);
    })(jQuery, window);
</script>