<?php
	$this->CI =& get_instance();
	$this->CI->load->library('ckeditor');

	$nameform	=	"contatos";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Contatos</a>
			<span class="divider">/</span>
		</li>
		<li class="active">Visualização da mensagem</li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Contatos</h5>
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
                    <label class="control-label">Assunto</label>
                    <div class="controls">
                        <?php echo $res['assunto']; ?>
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label">E-mail</label>
					<div class="controls">
						<?php echo $res['email']; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Mensagem</label>
					<div class="controls">
						<textarea name="mensagem" class="span7" rows="5" style="width:80%; height:150px;" disabled><?php echo $res['mensagem']; ?></textarea>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>