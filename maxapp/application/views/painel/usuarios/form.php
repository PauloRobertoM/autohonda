<?php
	$this->CI =& get_instance();
	$msg_header	=	(is_null($id)) ? "Cadastro de usuários do sistema" : "Atualização de usuários do sistema";
	$nameform	=	"usuarios";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Usuários</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Usuários</h5>
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
					<label class="control-label"></label>
					<div class="controls">
						<h5>Usuário pertencente ao(s) grupo(s)</h5>
					</div>
				</div>
				<div class="control-group">
					<div class="controls span9" style="margin-left:180px;">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Grupo</th>
									<th>Acesso</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($grupos as $lista_grupos)
									{
								?>
								<tr>
									<td><?php echo $lista_grupos['titulo']; ?></td>
									<td><input type="checkbox" id="checkbox" class="checkbox" name="grupo[]" value="<?php echo $lista_grupos['id']; ?>" <?php echo ($lista_grupos['checked']==1)?'checked':''; ?> /></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary btn-large btn-block span10" id="button_action" rel="<?php echo $this->input->post("mod"); ?>">Gravar dados</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>