<?php
	$this->CI =& get_instance();
	$this->CI->load->library('ckeditor');

	$msg_header	=	(is_null($id)) ? "Cadastro de páginas do sistema" : "Atualização de páginas do sistema";
	$nameform	=	"paginas";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Páginas</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Páginas</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<?php
				echo form_open(site_url('painel/'.$nameform.'/send/'.$pagina), array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
				echo form_hidden(array('id'=>$id, 'pagination'=>$pagina));
			?>
				<div class="control-group">
					<label class="control-label">Data</label>
					<div class="controls">
						<input name="data" class="span3 datetimepicker" type="text" value="<?php echo show_data_time($res['data']); ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Titulo</label>
					<div class="controls">
						<input name="titulo" class="span7" type="text" value="<?php echo $res['titulo']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Conteúdo</label>
					<div class="controls">
						<textarea name="conteudo" id="conteudo" rows="5"><?php echo $res['conteudo']; ?></textarea>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'conteudo' );
</script>