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

	<section class="conteudo consorcio">
		<div class="container">
			<div class="titulo-geral">
				<img src="<?=base_url("assets/site/images/seta.png");?>" alt="" class="bounceInLeft animated" >
				<h2 id="efeitoMaquina8"></h2>
			</div><!-- titulo-geral -->
			<div class="nome-pessoa">
				<h4>Nome Pessoa</h4>
				<p class="box">NP</p>
			</div><!-- nome-pessoa -->

			<form method="post" id="simulacao-consorcio">
				<div class="form-grupo">
					<input name="nome" type="text" id="nome" required="required" class="input-name" placeholder="Seu nome">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				<div class="form-grupo">
					<input name="telefone" type="text" id="telefone" required="required" class="input-name" placeholder="Seu telefone">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				<div class="form-grupo">
					<input name="email" type="email" id="email" required="required" class="input-name" placeholder="Seu email">
					<img src="<?=base_url("assets/site/images/seta2.png");?>" alt="">
				</div>
				
				<div class="form-grupo">
					<div class="selectWrapper">
						<select name="veiculos" id="veiculos-consorcio" class="input-name">
							<option>Veículo</option>
							<?php foreach($carros as $carro){ ?>
							<option value="<?=$carro['id']?>"><?=$carro['titulo'];?></option>
							<?php } ?>
						</select>
					</div><!-- selectWrapper -->
				</div><!-- form-grupo -->
				<div class="form-grupo">
					<div class="selectWrapper">
						<select name="parcelas" id="parcelas" class="input-name">
							<option><span>Parcelas</span></option>
							<option value="60"><span>60 Parcelas</span></option>
							<option value="72"><span>72 Parcelas</span></option>
							<option value="80"><span>80 Parcelas</span></option>
						</select>
					</div><!-- selectWrapper -->
				</div><!-- form-grupo -->

				<h4 id="sub-title" class="hidden sub-title">Gostou da parcela? Pré aprove seu cadastro AGORA!</h4>
				<h4 id="parcela-final">Parcelas de - </h4>
				<input type="hidden" name="active" id="active" value="0" />
				<input type="text" class="input-name hidden" name="cpf" id="cpf" placeholder="CPF:">
				<input type="text" class="input-name hidden" name="nascimento" id="nascimento" placeholder="Data de nascimento:">
				<div class="range-slider">
					<p>Entrada</p>
					<input name="entrada" class="range-slider__range" type="range" value="1500" min="1000" max="100000" step="500">
					<span class="range-slider__value">1500</span>
				</div><!-- .range-slider -->
				<input type="submit" id="submit" value="Ver Oferta" class="botao pull-right">
			</form>
		</div><!-- container -->
	</section><!-- conteudo -->
	
<?php include 'components/footer.php'; ?>

<script>
	var typed = new Typed('#efeitoMaquina8', {
    	strings: ["Simular Consórcio"],
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