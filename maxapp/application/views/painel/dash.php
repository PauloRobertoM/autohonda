<?php
	$this->CI =& get_instance();

	if(session("setor_id") <= 0) {
?>
	<div class="row-fluid" style="position:relative; top:10px;">
		<div style="overflow: visible;" class="widget span12">
			<a href="<?php echo site_url('painel/noticias'); ?>" class="btn btn-box span2">
				<i class="icon-book"></i>
				<span>Notícias</span>
			</a>
			<a href="<?php echo site_url('painel/albuns'); ?>" class="btn btn-box span2">
				<i class="icon-picture"></i>
				<span>Galeria</span>
			</a>
			<a href="<?php echo site_url('painel/contatos'); ?>" class="btn btn-box span2">
				<i class="icon-book"></i>
				<span>Contatos</span>
			</a>
			<a href="<?php echo site_url('painel/paginas'); ?>" class="btn btn-box span2">
				<i class="icon-upload-alt"></i>
				<span>Páginas</span>
			</a>
		</div>
	</div>
<?php
	}
?>
<div class="row-fluid" style="position:relative; top:10px;">
	<div class="widget span9">
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