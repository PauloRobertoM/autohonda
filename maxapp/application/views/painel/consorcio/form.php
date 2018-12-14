<?php
	$this->CI =& get_instance();
	//$this->CI->load->library('ckeditor');

	$msg_header	=	(is_null($id)) ? "Cadastro de consorcio de consórcio do sistema" : "Atualização de consorcio de consórcio do sistema";
	$nameform	=	"consorcio";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Consórcio</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Consórcio</h5>
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
					<label class="control-label">Carro</label>
					<div class="controls">
						<select id="carros_select" class="span10" name="carro_id">
                            <option value="0">Selecione</option>
							<?php
								foreach($carros as $carro)
								{
									$selected = ($carro['id'] == $res['carro_id']) ? 'selected' : '' ;
									echo '<option value="'.$carro['id'].'" '.$selected.' >'.$carro['titulo'].'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Parcelas</label>
					<div class="controls">
						<select name="parcelas" class="span2">
                        	<option value="">Selecione</option>
							<option value="60" <?php echo ($res['parcelas'] == "60") ? "selected='selected'" : "" ; ?>>60 Parcelas</option>
							<option value="72" <?php echo ($res['parcelas'] == "72") ? "selected='selected'" : "" ; ?>>72 Parcelas</option>
							<option value="80" <?php echo ($res['parcelas'] == "80") ? "selected='selected'" : "" ; ?>>80 Parcelas</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						Whatsapp do vendedor responsável<br />
					</label>
					<div class="controls">
						<input name="telefone" class="span2" type="text telefone" id="telefone" placeholder="55(DDD)numero" value="<?php echo htmlspecialchars($res['telefone']); ?>" style="float:left;" />
					</div>
				</div>
				<h4>Coeficientes</h4>
				<div class="control-group">
					<label class="control-label">
						Taxa de administração<br />
					</label>
					<div class="controls">
						<input name="taxa_adm" class="span2 taxa-adm" type="text" value="<?php echo htmlspecialchars($res['taxa_adm']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						Fundo de reserva<br />
					</label>
					<div class="controls">
						<input name="fundo_res" class="span2 fundo-res" type="text" value="<?php echo htmlspecialchars($res['fundo_res']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						Seguro<br />
					</label>
					<div class="controls">
						<input name="seguro" class="span2 coeficiente" type="text" value="<?php echo htmlspecialchars($res['seguro']); ?>" style="float:left;" />
					</div>
				</div>
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
		$("#carros_select").select2({maximumSelectionSize: 1});
	});
</script>