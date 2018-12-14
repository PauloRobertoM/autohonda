<?php
	$this->CI =& get_instance();
	$nameform = "simulacoes";
?>
	<div class="row-fluid">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo site_url('painel/home'); ?>" class="hashed">Home</a>
				<span class="divider">/</span>
			</li>
			<li>
				<a href="<?php echo site_url('painel/'.$nameform); ?>">Simulações de parcelas</a>
				<span class="divider">/</span>
			</li>
			<li class="active">Listagem das simulações de parcelas do sistema</li>
		</ul>
	</div>

	<div class="row-fluid">
		<div class="widget widget-padding">
			<div class="widget-header">
				<i class="icon-reorder"></i>
				<h5>Simulações de parcelas</h5>
				<div class="widget-buttons">
					<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
				</div>
			</div>
			<div class="widget-body">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>NOME</th>
							<th>E-MAIL</th>
							<th>STATUS</th>
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
									<td><?php echo $items['nome']; ?></td>
									<td><?php echo $items['email']; ?></td>
									<td>
										<?php echo status2($items['lido'], 'info'); ?>
									</td>
									<td class="action">
										<?php
											if($this->Model_modulos->check_actions('upd', $nameform) === TRUE) {
												//echo btn_status(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>status($items['status'], 'info'), "img"=>status($items['status'], 'image')));
												echo btn_editar(array("nameform"=>$nameform, "id"=>$items['id'], "page"=>$page, "title"=>"Ver", "img"=>"preview"));
											}
											if($this->Model_modulos->check_actions('del', $nameform) === TRUE) {
												echo btn_excluir(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>"Excluir", "img"=>"trashcan"));
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