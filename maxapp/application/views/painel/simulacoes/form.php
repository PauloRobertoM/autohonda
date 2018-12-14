<?php
	$this->CI =& get_instance();
	$this->CI->load->library('ckeditor');

	$nameform	=	"simulacoes";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;

	$parcelas = ['1' => '3 parcelas', '2' => '6 parcelas', '3' => '9 parcelas', '4' => '12 parcelas', '5' => '18 parcelas', '6' => '24 parcelas', '7' => '36 parcelas', '8' => '48 parcelas'
				, '9' => '60 parcelas'];
	 
	$sql_carros['where']		=	array(
		'id'		=>	(int)$res['carro_id'],
		'status'	=>	1,
	);
	$model_carros	=	load_model('generico', 'carros');
	$query_carros	=	$model_carros->get_query($sql_carros, NULL, NULL, TRUE);
	$result_carros	=	$model_carros->render_query(
		array(
			'query'	=>	$query_carros,
			'type'	=>	'array'
		)
	);
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Simulações de parcelas</a>
			<span class="divider">/</span>
		</li>
		<li class="active">Visualização</li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Simulações de parcelas</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<?php
				echo form_open(site_url('painel/'.$nameform.'/'.$pagina), array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal'));
			?>
				<div class="control-group">
					<label class="control-label">Data</label>
					<div class="controls">
						<?php echo show_data_time($res['data']); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Nome</label>
					<div class="controls">
						<?php echo $res['nome']; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">E-mail</label>
					<div class="controls">
						<?php echo $res['email']; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Telefone</label>
					<div class="controls">
						<?php echo $res['telefone']; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Entrada</label>
					<div class="controls">
						<?php echo $res['entrada']; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Parcelas</label>
					<div class="controls">
						<?php echo $parcelas[$res['parcelas']]; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Carro</label>
					<div class="controls">
						<?php echo $result_carros[0]["titulo"]; ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>