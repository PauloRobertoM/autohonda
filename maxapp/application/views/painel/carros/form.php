<?php
	$this->CI =& get_instance();
	//$this->CI->load->library('ckeditor');

	$msg_header	=	(is_null($id)) ? "Cadastro de veículos do sistema" : "Atualização de veículos do sistema";
	$nameform	=	"carros";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Veículos</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Veículos</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<?php
				echo form_open(site_url('painel/'.$nameform.'/send/'.$pagina), array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
				echo form_hidden(array('id'=>$id, 'pagination'=>$pagina, 'folder'=>$res['folder']));
			?>
				<div class="control-group">
					<label class="control-label">
						Titulo *<br />
						<span style="font-weight:bold;">Total <span id="charsLeftTitulo"></span>.</span>
					</label>
					<div class="controls">
						<input id="titulolimit" name="titulo" class="span10" type="text" required="required" value="<?php echo htmlspecialchars($res['titulo']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						Valor de venda<br />
					</label>
					<div class="controls">
						<input name="valor" class="span2 monetario" type="text" required="required" placeholder="R$" value="<?php echo htmlspecialchars($res['valor']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						TAC<br />
					</label>
					<div class="controls">
						<input name="tac" class="span2 monetario" type="text" required="required" placeholder="R$" value="<?php echo htmlspecialchars($res['tac']); ?>" style="float:left;" />
					</div>
				</div>
			    <div class="control-group">
					<label class="control-label">Informações</label>
					<div class="controls">
						<div class="alert alert-info span10">
							<b>=== Dica para redimensionamento das imagens ===</b> <br />
							Clicar na imagem carregado para selecionar a área que será cortada.<br />
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Interna</label>
					<div class="controls">
						<input name="arquivo" class="span7" type="file" style="width:250px;" id="seleciona-imagem"/>
						<div id="imagem-box">
				            <img src="" style="display:none;width:50%;" id="visualizacao_img" />
				            <input type="hidden" id="x" name="x">
							<input type="hidden" id="y" name="y">
							<input type="hidden" id="wcrop" name="wcrop">
							<input type="hidden" id="hcrop" name="hcrop">
							<input type="hidden" id="wvisualizacao" name="wvisualizacao">
							<input type="hidden" id="hvisualizacao" name="hvisualizacao">
							<input type="hidden" id="woriginal" name="woriginal">
							<input type="hidden" id="horiginal" name="horiginal">
				        </div>
					</div>
				</div>
				<?php if($res['arquivo'] != ""){ ?>
					<div class="control-group">
						<label class="control-label">Interna Atual</label>
						<div class="controls" id="imagem-box">
							<img src="<?php echo site_url('_ups/' . $nameform . '/' . $res['folder'] . "/" . $res['arquivo']); ?>" width="200"/>
						</div>
					</div>
				<?php } ?>
                <div class="control-group">
                	<div class="controls">
                		<button id="button_action" class="btn btn-primary btn-large btn-block span10" type="submit">Enviar</button>
                	</div>
                </div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.limit-1.2.source.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/Jcrop/js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#titulolimit').limit('80', '#charsLeftTitulo');

		$("#seleciona-imagem").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                // Define o que será executado após o carregamento da imagem
                reader.onload = function (e) {
                    // Passa para os elementos no DOM as informações
                    // sobre a imagem a ser exibida e os textos
                    $('#visualizacao_img').attr('src', e.target.result);
                    $('#visualizacao_img').removeClass('hidden');
                    $('#recortar-imagem').removeClass('hidden');
                    $('#texto-informativo').html('Arraste o cursor sobre a imagem para selecionar a área de corte.');
                    $('#texto-informativo').removeClass('alert-info').addClass('alert-success');

                    // Ativa o recurso de recorte
                    $('#visualizacao_img').Jcrop({                      
                        minSize :   [420,400],
                        maxSize :   [420,400],
                        allowRezise :   false,
                        onSelect: atualizaCoordenadas,
                        onChange: atualizaCoordenadas
                    });

                    // Calcula o tamanho da imagem
                    defineTamanhoImagem(e.target.result,$('#visualizacao_img'));
                }

                // Carrega a imagem e chama o 'reader.onload'
                reader.readAsDataURL(this.files[0]);
            }
        });
		
		$('#recortar-imagem').click(function(){
            if (parseInt($('#wcrop').val())) return true;
            alert('Selecione a área de corte para continuar.');
            return false;
        });
		
		});
 
		function atualizaCoordenadas(c)
		{
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#wcrop').val(c.w);
			$('#hcrop').val(c.h);
		};

		// Faz a verificação e define o tamanho da imagem original
		// e da imagem na área de visualização para o recorte
		function defineTamanhoImagem(imgOriginal, imgVisualizacao) {
			var image = new Image();
			image.src = imgOriginal;

			image.onload = function() {
				$('#wvisualizacao').val(imgVisualizacao.width());
				$('#hvisualizacao').val(imgVisualizacao.height());
				$('#woriginal').val(this.width);
				$('#horiginal').val(this.height);
			};
		}

		$(function(){
			$('#jcrop').Jcrop();
		});
</script>