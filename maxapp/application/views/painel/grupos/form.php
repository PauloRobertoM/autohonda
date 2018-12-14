<?php
	$this->CI =& get_instance();
	$msg_header	=	(is_null($id)) ? "Cadastro de grupos do sistema" : "Atualização de grupos do sistema";
	$nameform	=	"grupos";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Grupos</a>
			<span class="divider">/</span>
		</li>
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Grupos</h5>
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
					<label class="control-label">E-mail</label>
					<div class="controls">
						<input name="email" class="span7" type="text" value="<?php echo $res['email']; ?>" style="width:80%; text-transform:lowercase;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<h4>Módulos deste grupo e suas permissões</h4>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Acessar</th>
									<th>Adicionar</th>
									<th>Atualizar</th>
									<th>Deletar</th>
								</tr>
							</thead>
							<tbody>
								<?php
	                           		$lista_modulos = $this->CI->Model_modulos->get_list_modulos($id);
									$i = 0;
									foreach($lista_modulos as $lista_modulo)
									{
								?>
								<tr>
									<input name="modulo[]" type="hidden" value="<?php echo $lista_modulo['id'] ; ?>" />
									<td><?php echo $lista_modulo['nome']; ?></td>
									<td><input class="checkbox" type="checkbox" name="view[<?php echo $lista_modulo['id']; ?>]" value="1" <?php echo $lista_modulo['view']; ?> id="check" /></td>
									<td><input class="checkbox" type="checkbox" name="add[<?php echo $lista_modulo['id']; ?>]" value="1" <?php echo $lista_modulo['add']; ?> id="check" /></td>
									<td><input class="checkbox" type="checkbox" name="upd[<?php echo $lista_modulo['id']; ?>]" value="1" <?php echo $lista_modulo['upd']; ?> id="check" /></td>
									<td><input class="checkbox" type="checkbox" name="del[<?php echo $lista_modulo['id']; ?>]" value="1" <?php echo $lista_modulo['del']; ?> id="check" /></td>
								</tr>
								<?php
										$i++;
									}
								?>
								<tr>
									<td colspan="2">Total: <span class="red strong">[<?php echo $i; ?>]</span></td>
									<td colspan="3" style="text-align:right;">Marcar <a href="javascript:void(0);" id="marcar" class="btn btn-small btn-primary">TODOS</a> <a href="javascript:void(0);" id="desmarcar" class="btn btn-small btn-inverse">NENHUM</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <div class="control-group">
                	<div class="controls">
                		<button id="button_action" class="btn btn-primary btn-large btn-block" type="submit">Enviar</button>
                	</div>
                </div>
			</form>
		</div>
	</div>
</div>