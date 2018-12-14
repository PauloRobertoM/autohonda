<?php
	$this->CI =& get_instance();
?>
<div class="row-fluid" style="position:relative; top:10px;">
	<div style="overflow: visible;" class="widget span12">
		<a href="<?php echo site_url('painel/categorias'); ?>" class="btn btn-box span2">
			<i class="icon-calendar"></i>
			<span>Categorias</span>
		</a>
		<a href="<?php echo site_url('painel/equipe'); ?>" class="btn btn-box span2">
			<i class="icon-bookmark"></i>
			<span>Equipe</span>
		</a>
		<a href="<?php echo site_url('painel/noticias'); ?>" class="btn btn-box span2">
			<i class="icon-picture"></i>
			<span>Notícias</span>
		</a>
		<a href="<?php echo site_url('painel/agenda'); ?>" class="btn btn-box span2">
			<i class="icon-film"></i>
			<span>Agenda</span>
		</a>
		<a href="<?php echo site_url('painel/contatos'); ?>" class="btn btn-box span2">
			<i class="icon-book"></i>
			<span>Contatos</span>
		</a>
		<a href="<?php echo site_url('painel/arquivos'); ?>" class="btn btn-box span2">
			<i class="icon-upload-alt"></i>
			<span>Arquivos</span>
		</a>
        <a href="<?php echo $link; ?>" class="btn btn-box span2">
			<i class="icon-bullhorn"></i>
			<?php echo $radio; ?>
		</a>
	</div>
</div>

<div class="row-fluid">
	<div class="widget span6">
		<div class="widget-header">
			<i class="icon-signal"></i>
			<h5>Analytics</h5>
		</div>
		<div class="widget-body clearfix">
			<div id="linechart" class="analytics_item"></div>
		</div>
	</div>
	<div class="widget span3">
		<div class="widget-header">
			<i class="icon-signal"></i>
			<h5>Total de registros</h5>
		</div>
		<div class="widget-header-under">Referente à todos os módulos</div>
		<div style="min-height: 319px;" class="widget-body clearfix">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Módulo</th>
						<th>Registros</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Agenda</td>
						<td><strong><?php echo $t_agenda; ?></strong></td>
					</tr>
					<tr>
						<td>Arquivos</td>
						<td><strong><?php echo $t_arquivos; ?></strong></td>
					</tr>
					<tr>
						<td>Categorias</td>
						<td><strong><?php echo $t_categorias; ?></strong></td>
					</tr>
					<tr>
						<td>Equipe</td>
						<td><strong><?php echo $t_equipe; ?></strong></td>
					</tr>
					<tr>
						<td>Notícias</td>
						<td><strong><?php echo $t_noticias; ?></strong></td>
					</tr>
					<tr>
						<td>Logs</td>
						<td><strong><?php echo $t_logs; ?></strong></td>
					</tr>
					<tr>
						<td>Contatos</td>
						<td><strong><?php echo $t_contatos; ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="widget span3">
		<div class="widget-header">
			<i class="icon-signal"></i>
			<h5>Logs do sistema</h5>
		</div>
		<div class="widget-header-under">Os últimos logs do sistema</div>
		<div style="min-height: 319px;" class="widget-body clearfix">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Usuário</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($logs as $log) {
					?>
					<tr>
						<td><?php echo $log['nome']; ?></td>
						<td><strong><?php echo $log['acao']; ?></strong></td>
					</tr>
					<?php
						} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$('.analytics_item').html('Carregando...');

	$.ajax({
		type		:	"POST",
		url			:	http_base + "/analytics",
		cache		:	false,
		dataType	:	"json",
		success		:	function(data)
		{
			$('.analytics_item').html('');

			Morris.Area({
				element		:	'linechart',
				data		:	data,
				xkey		:	'x',
				ykeys		:	['y', 'z'],
				smooth		:	false,
			    lineColors	:	['#42C1F7','#65A7BF'],
			    //fillColor	:	'#B3E6FC',
				labels		:	['Visitas', 'Visualizações']
			}); 
		}
	});
</script>