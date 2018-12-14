<?php
	$bg = array('#1ecd6d', '#e94b35', '#33495f', '#b078c6', '#00a185', '#2c97de'); // array of filenames
	$i = rand(0, count($bg)-1); // generate random number size of the array
	$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">
	.nome-pessoa p {
	    background: <?php echo $selectedBg; ?>;
	}
</style>

<?php include 'components/header.php'; ?>
	
	<div id="ancora-final"></div>
	<section class="topo">
		<img src="<?=base_url("assets/site/images/logo.png");?>" alt="" class="logo">
	</section><!-- topo -->

	<section class="conteudo index1">
		<div class="container">
			<div class="titulo-geral">
				<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
				<h2 id="efeitoMaquina2"></h2>
			</div><!-- titulo-geral -->
			<div class="nome-pessoa">
				<h4>Nome Pessoa</h4>
				<p class="box">NP</p>
			</div><!-- nome-pessoa -->

			<form method="post" action="<?=base_url("/step-2");?>">
				<div id="form-name" class="form-grupo">
					<input name="nome" type="text" id="nome" required="required" class="input-name" placeholder="Seu nome">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				<div id="form-fone" class="hidden form-grupo">
					<input name="telefone" type="text" id="telefone" required="required" class="input-name" placeholder="Seu telefone">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				<div id="form-email" class="hidden form-grupo">
					<input name="email" type="email" id="email" required="required" class="input-name" placeholder="Seu email">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				<input type="submit" id="submit" value="Próximo passo" class="botao pull-right hidden">
			</form>
		</div><!-- container -->
	</section><!-- conteudo -->

<?php include 'components/footer.php'; ?>

<script>
	var typed = new Typed('#efeitoMaquina2', {
    	strings: ["Oi, podemos conversar? É rapidinho."],
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