<?php
	$this->CI =& get_instance();
	$msg_header	=	(is_null($id)) ? "Cadastro de módulos do sistema" : "Atualização de módulos do sistema";
	$nameform	=	"modulos";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Módulos</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Módulos</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<?php
				echo form_open(site_url('painel/'.$nameform.'/send/'.$pagina), array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal'));
				echo form_hidden(array('id'=>$id, 'pagination'=>$pagina));
			?>
				<div class="control-group">
					<label class="control-label">Titulo</label>
					<div class="controls">
						<input name="titulo" class="span7" type="text" value="<?php echo $res['titulo']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Url</label>
					<div class="controls">
						<input name="url" class="span7" type="text" value="<?php echo $res['url']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Model</label>
					<div class="controls">
						<input name="model" class="span7" type="text" value="<?php echo $res['model']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Upload</label>
					<div class="controls">
						<input name="file" type="checkbox" value="<?php echo ($res['file'] == 1) ? 'checked="checked"' : '' ; ?>" />
						<code>Selecione se for adicionar o módulo como opção na lista de upload de arquivos.</code>
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