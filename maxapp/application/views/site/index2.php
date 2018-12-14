<?php 
	if(post('nome') != ''){
		$nome = post('nome');
	}if(post('telefone') != ''){
		$telefone = post('telefone');
	}if(post('email') != ''){
		$email = post('email');
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
	
	<section class="topo">
		<img src="<?=base_url("assets/site/images/logo.png");?>" alt="" class="logo">
	</section><!-- topo -->

	<section class="conteudo index1">
		<div class="container">
			<div class="titulo-geral">
				<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
				<h2 id="efeitoMaquina3"></h2>
			</div><!-- titulo-geral -->
			<div class="nome-pessoa">
				<h4>Nome Pessoa</h4>
				<p class="box">NP</p>
			</div><!-- nome-pessoa -->

			<form method="post" action="<?=base_url("/step-final");?>">
				<div class="form-grupo">
					<div class="selectWrapper">
						<select name="veiculos" id="veiculos" class="input-name">
							<option>Veículo</option>
							<?php foreach($carros as $carro){ ?>
							<option value="<?=$carro['id']?>"><?=$carro['titulo'];?></option>
							<?php } ?>
						</select>
					</div><!-- selectWrapper -->
				</div><!-- form-grupo -->

				<input type="hidden" name="nome" value="<?=$nome;?>"> 
				<input type="hidden" name="telefone" value="<?=$telefone;?>"> 
				<input type="hidden" name="email" value="<?=$email;?>"> 
				<input type="submit" id="submit" value="Próximo passo" class="botao pull-right">
			</form>
		</div><!-- container -->
	</section><!-- conteudo -->

<?php include 'components/footer.php'; ?>

<script>
	var typed = new Typed('#efeitoMaquina3', {
    	strings: ["Agora, vamos ao que interessa: o carro dos seus sonhos."],
    	typeSpeed: 80,
	    startDelay: 800,
	    showCursor: false
    });

    (function($, window) {
    	$('html, body').animate({
            scrollTop: $('#efeitoMaquina3').offset().top
        }, 2000);
    })(jQuery, window);
</script>