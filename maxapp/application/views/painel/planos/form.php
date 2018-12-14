<?php
	$this->CI =& get_instance();
	//$this->CI->load->library('ckeditor');

	$msg_header	=	(is_null($id)) ? "Cadastro de planos de financiamento do sistema" : "Atualização de planos de financiamento do sistema";
	$nameform	=	"planos";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Planos</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Planos</h5>
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
						<input id="titulolimit" name="titulo" class="span6" type="text" required="required" value="<?php echo htmlspecialchars($res['titulo']); ?>" style="float:left;" />
					</div>
				</div>
				<!--<div class="control-group">
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
				</div>-->
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
						<?='3 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente1" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente1']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente1_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente1_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente1_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente1_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='6 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente2" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente2']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente2_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente2_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente2_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente2_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='9 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente3" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente3']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente3_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente3_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente3_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente3_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='12 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente4" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente4']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente4_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente4_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente4_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente4_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='18 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente5" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente5']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente5_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente5_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente5_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente5_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='24 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente6" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente6']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente6_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente6_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente6_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente6_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='36 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente7" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente7']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente7_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente7_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente7_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente7_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='48 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente8" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente8']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente8_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente8_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente8_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente8_2']); ?>" style="float:left;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">
						<?='60 Parcelas < 30%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente9" class="span1 coeficiente" type="text" value="<?php echo htmlspecialchars($res['coeficiente9']); ?>" style="float:left;" />
					</div>
					<label class="control-label" style="width:80px;">
						<?='< 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente9_1" class="span1 coeficiente" type="text" style="margin-left:20px;" value="<?php echo htmlspecialchars($res['coeficiente9_1']); ?>" style="float:left;" />
					</div>
					<label class="control-label">
						<?='> 40%';?> <br />
					</label>
					<div class="controls">
						<input name="coeficiente9_2" class="span1 coeficiente" type="text" style="margin-top:10px;" value="<?php echo htmlspecialchars($res['coeficiente9_2']); ?>" style="float:left;" />
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