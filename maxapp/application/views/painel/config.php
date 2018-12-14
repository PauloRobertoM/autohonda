<?php
	$this->CI =& get_instance();

	$nameform	=	"config";
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Configuração</a>
			<span class="divider">/</span>
		</li>
		<li class="active">Atualização de meus dados no sistema</li>
	</ul>
</div>
<div class="row-fluid">
	<?php
		echo form_open(site_url('painel/'.$nameform), array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal'));
	?>
		<div class="widget">
			<div class="widget-header">
				<i class="icon-cogs"></i>
				<h5>Meus dados</h5>
			</div>
			<div class="widget-body">
				<?php
					if($retorno['sucesso'] != ""){
				?>
					<div class="control-group success">
						<div class="controls">
							<span class="help-inline"><?php echo $retorno['sucesso']; ?></span>
						</div>
					</div>
				<?php
					}
	
					if($retorno['error'] != ""){
				?>
					<div class="control-group error">
						<div class="controls">
							<span class="help-inline"><?php echo $retorno['error']; ?></span>
						</div>
					</div>
				<?php
					}
				?>
				<div class="control-group">
					<label class="control-label">Nome</label>
					<div class="controls">
						<input name="nome" class="span7" type="text" value="<?php echo $res['nome']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">E-mail</label>
					<div class="controls">
						<input name="email" class="span7" type="text" value="<?php echo $res['email']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Login</label>
					<div class="controls">
						<input name="username" class="span7" type="text" value="<?php echo $res['username']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Senha</label>
					<div class="controls">
						<input type="password" name="password" class="span7" type="text" value="" style="width:80%;" />
					</div>
				</div>
	            <div class="control-group">
	               	<div class="controls">
	               		<button id="button_action" class="btn btn-primary btn-large" type="submit">Enviar</button>
	               	</div>
	            </div>
			</div>
		</div>
	</form>
</div>