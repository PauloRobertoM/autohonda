<?php 
	if(post('nome') != ''){
		$nome = post('nome');
	}if(post('telefone') != ''){
		$telefone = post('telefone');
	}if(post('email') != ''){
		$email = post('email');
	}if(post('veiculos') != ''){
		$veiculos = post('veiculos');
	}
?>
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

	<section class="conteudo index1 index3">
		<div class="container">
			<div class="titulo-geral">
				<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
				<h2 id="efeitoMaquina4"></h2>
			</div><!-- titulo-geral -->
			<div class="nome-pessoa">
				<h4>Nome Pessoa</h4>
				<p class="box">NP</p>
			</div><!-- nome-pessoa -->

			<form method="post" id="simulacao">
				<div class="form-grupo">
					<div class="selectWrapper">
						<select name="parcelas" id="parcelas" class="input-name">
							<option value="1">3 Parcelas</option>
							<option value="2">6 Parcelas</option>
							<option value="3">9 Parcelas</option>
							<option value="4">12 Parcelas</option>
							<option value="5">18 Parcelas</option>
							<option value="6">24 Parcelas</option>
							<option value="7">36 Parcelas</option>
							<option value="8">48 Parcelas</option>
							<option value="9">60 Parcelas</option>
						</select>
					</div><!-- selectWrapper -->
				</div><!-- form-grupo -->

				<div class="range-slider" id="slider">
					<label for="entrada">Sua entrada:</label>
					<input name="entrada" class="range-slider__range" type="range" value="1500" min="1000" max="100000" step="500">
					<span class="range-slider__value">1500</span>
				</div><!-- .range-slider -->

				<h4 id="parcela-final">A melhor parcela: </h4>

				<!-- <h4  class=" sub-title">Gostou da parcela? Pré aprove seu cadastro AGORA!</h4> -->
				<div id="sub-title" class="titulo-geral hidden">
					<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
					<h2 id="efeitoMaquina5"></h2>
				</div><!-- titulo-geral -->

				<div class="">
					<input type="text" class="input-name hidden" name="cpf" id="cpf" placeholder="CPF:">
				</div>
				<div class="">
					<input type="text" class="input-name hidden" name="nascimento" id="nascimento" placeholder="Data de nascimento:">
				</div>
				
				<input type="hidden" name="active" id="active" value="0" />							
				<input type="hidden" name="nome" value="<?=$nome;?>"> 
				<input type="hidden" name="telefone" value="<?=$telefone;?>"> 
				<input type="hidden" name="email" value="<?=$email;?>"> 
				<input type="hidden" name="veiculos" id="veiculos" value="<?=$veiculos;?>"> 
				<input type="submit" id="submit" value="Próximo passo" class="botao pull-right">
			</form>
		</div><!-- container -->
	</section><!-- conteudo -->

<?php include 'components/footer.php'; ?>
<script>
	var typed = new Typed('#efeitoMaquina4', {
    	strings: ["Bela escolha. Tô vendo que você curte aventura e liberdade. Agora, vamos facilitar pra você."],
    	typeSpeed: 30,
	    startDelay: 500,
	    showCursor: false
    });
    var typed = new Typed('#efeitoMaquina5', {
    	strings: ["Gostou da parcela? Pré aprove seu cadastro AGORA."],
    	typeSpeed: 30,
	    startDelay: 500,
	    showCursor: false
    });

    (function($, window) {
    	$('html, body').animate({
            scrollTop: $('#efeitoMaquina4').offset().top
        }, 2000);
    })(jQuery, window);
</script>