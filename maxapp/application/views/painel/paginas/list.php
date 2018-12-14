<?php
	$this->CI =& get_instance();
	$nameform = "paginas";
?>
	<div class="row-fluid">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo site_url('painel/home'); ?>" class="hashed">Home</a>
				<span class="divider">/</span>
			</li>
			<li>
				<a href="<?php echo site_url('painel/'.$nameform); ?>">Páginas</a>
				<span class="divider">/</span>
			</li>
			<li class="active">Listagem das páginas do sistema</li>
		</ul>
	</div>

	<div class="row-fluid">
		<div class="widget widget-padding">
			<div class="widget-header">
				<i class="icon-reorder"></i>
				<h5>Páginas</h5>
				<div class="widget-buttons">
					<?php
						if($this->Model_modulos->check_actions('add', $nameform) === TRUE) {
							echo "<a href='".site_url('painel/'.$nameform.'/add')."' data-title='Novo registro' class='tip'><i class='icon-plus'></i> </a>";
						}
					?>
					<a href="<?php echo site_url('painel/'.$nameform.'/trash'); ?>" data-title="Lixeira" class="tip"><i class="icon-trash"></i> </a>
					<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
				</div>
			</div>
			<div class="widget-body">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>TITULO</th>
							<th>SLUG</th>
							<th class="action">AÇÕES</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(count($lista) > 0)
							{
								foreach($lista as $items)
								{
						?>
								<tr id="i_<?php echo $items['id']; ?>">
									<td><?php echo $items['id']; ?></td>
									<td><?php echo show_data_site($items['data'], "%d/%m/%Y"); ?></td>
									<td><?php echo $items['titulo']; ?></td>
									<td><?php echo $items['slug']; ?></td>
									<td class="action">
										<?php
											if($items['excluido'] == 0)
											{
												if($this->Model_modulos->check_actions('upd', $nameform) === TRUE) {
													echo btn_status(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>status($items['status'], 'info'), "img"=>status($items['status'], 'image')));
													echo btn_editar(array("nameform"=>$nameform, "id"=>$items['id'], "page"=>$page, "title"=>"Editar", "img"=>"paint_brush"));
												}
												if($this->Model_modulos->check_actions('del', $nameform) === TRUE) {
													echo btn_excluir(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>"Excluir", "img"=>"trashcan"));
												}
											}
											else
											{
												if($this->Model_modulos->check_actions('upd', $nameform) === TRUE) {
													echo btn_ativar(array("nameform"=>$nameform, "page"=>$page, "id"=>$items['id'], "title"=>"Ativar", "img"=>"trashcan"));
												}
											}
										?>
									</td>
								</tr>
						<?php
								}
							}
							else
							{
						?>
								<tr>
                                	<td colspan="10" style="text-align:center;">
                                        Nenhum registro inserido
                                	</td>
                        		</tr>
						<?php								
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="10" style="text-align:center;">
								<?php
									if(count($pagination) > 0)
									{
										echo $pagination;
									}
								?>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>