<?php
	$this->CI =& get_instance();

	$nameform	=	"arquivos";	
?>
<link href="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/plupload.full.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.ui.plupload/jquery.ui.plupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/i18n/pt-br.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.jeditable.js"></script>

<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Arquivos</a>
			<span class="divider">/</span>
		</li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget span9">
		<div class="widget-header">
			<i class="icon-picture"></i>
			<h5>Arquivos</h5>
			<div class="widget-buttons">
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<table class="table" id="tbl">
				<thead>
					<tr>
						<th>ID</th>
						<th>ARQUIVO</th>
						<th>LEGENDA</th>
						<th>CREDITO</th>
						<th>TIPO</th>
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
									<td>
										<a href="<?php echo "_ups/arquivos/" . $items['folder'] . "/" . $items['arquivo']; ?>" class="prettyphoto" title="<?php echo $items['legenda']; ?>">
											<img src="<?php echo "_ups/arquivos/" . $items['folder'] . "/" . $items['arquivo']; ?>" style="max-height:40px;" />
										</a>
									</td>
									<td class="edit-input" id="<?php echo $items['id']; ?>" rel="legenda" title="Duplo clique para editar"><?php echo $items['legenda']; ?></td>
									<td class="edit-input" id="<?php echo $items['id']; ?>" rel="credito" title="Duplo clique para editar"><?php echo $items['credito']; ?></td>
									<td><?php echo show_extension_name($items['extension']); ?></td>
									<td class="action">
										<?php
											//echo btn_editar_arquivo(array("nameform"=>$nameform, "id"=>$items['id'], "page"=>$page, "title"=>"Redimensionar", "img"=>'fullscreen'));
											echo btn_excluir(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>"Excluir", "img"=>"trashcan"));
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
							<td colspan="10" style="text-align:center;">Nenhum registro</td>
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
	<div class="widget span3">
		<div class="widget-header">
			<i class="icon-upload-alt"></i>
			<h5>Upload</h5>
			<div class="widget-buttons">
				<a href="javascript:void(0);" class="info-help"><i class="icon-question-sign"></i> </a>
			</div>
		</div>
		<div style="min-height: 319px;" class="widget-body clearfix">
			<table class="table table-striped">
				<?php
					if($this->Model_modulos->check_actions('add', $nameform) === TRUE) {
				?>
					<thead>
                		<tr>
							<th>Data</th>
							<th>Módulo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" class="datepicker span8" id="data" placeholder="DD/MM/AAAA" value="<?php echo date("d/m/Y"); ?>" /></td>
							<td>
								<select id="modulos" class="span12">
									<option value="0" selected>Em todos os módulos</option>
									<?php
										foreach($modulos as $modulo) {
											echo '<option value="'.$modulo["id"].'">Em '.$modulo["titulo"].'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="uploader">
									<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
								</div>
							</td>
						</tr>
					<?php
						} else {
							echo "<tbody>";
						}
					?>
					<tr>
						<td>Tamanho máximo</td>
						<td>Máx: <strong><?php echo (strtoupper(config("max_size")) / 1024); ?>MB cada</strong></td>
					</tr>
					<tr>
						<td>Largura para img</td>
						<td>Máx: <strong><?php echo (strtoupper(config("max_width"))); ?>px</strong></td>
					</tr>
					<tr>
						<td>Tipos de doc</td>
						<td><strong>PDF, DOC, XLS</strong></td>
					</tr>
					<tr>
						<td>Tipos de imgs</td>
						<td><strong>JPG, GIf, PNG</strong></td>
					</tr>
					<tr>
						<td>Tipo de vídeos</td>
						<td><strong>FLV</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var user_id = '<?php echo session('uid'); ?>';
var site_url = '<?php echo site_url('painel/'.$nameform.'/crop'); ?>';

$(function()
{
	$("#uploader").plupload({
		runtimes			:	'html5,html4,browserplus',
		max_file_size		:	'10mb',
		chunk_size			:	'1mb',
		unique_names		:	true,
		url					:	base_url + 'painel/files/upload/arquivos',
		//resize			:	{width : 320, height : 240, quality : 90},
	    preinit : {
			UploadFile: function(up, file) {
				up.settings.multipart_params = {'data':$("#data").val(), 'modulo':$("#modulos").val(), 'usuario_id':user_id};
			}
		},
		init : {
			FileUploaded: function(up, file, response) {
				var data = JSON.parse( response.response );

				var div = '';
				div +=	'<tr id="i_'+data.id+'">';
				div +=		'<td>'+data.id+'</td>';
				div +=		'<td><a href="_ups/arquivos/'+data.folder+'/'+data.status.file_name+'" class="prettyphoto" title="'+data.status.raw_name+'"><img src="_ups/arquivos/'+data.folder+'/'+data.status.file_name+'" style="max-height:40px;" /></a></td>';
				div +=		'<td class="edit-input" id="'+data.id+'" rel="legenda" title="Duplo clique para editar">'+data.status.raw_name+'</td>';
				div += 		'<td class="edit-input" id="'+data.id+'" rel="credito" title="Duplo clique para editar"></td>';
				div +=		'<td>'+data.status.file_ext.replace(".", "")+'</td>';
				div += 		'<td class="action">';
				//div += 			'<a href="'+site_url+'/'+data.id+'/<?php echo $page; ?>" class="btn btn-mini tip" title="Redimensionar"><img src="'+base_url + 'assets/painel/img/icons/dark/fullscreen.png" /></a> ';
				div += 			'<a href="javascript:void(0);" id="'+data.id+'" class="btn btn-mini tip del" rel="arquivos" title="Excluir"><img src="'+base_url + 'assets/painel/img/icons/dark/trashcan.png" /></a>';
				div += 		'</td>';
				div +=	'</tr>';

				$('table#tbl').find("tbody tr:first").before(div).show('slow');

				$.each(files, function(i, file) {
		            up.removeFile(file);    
		        });
			}
		},
		filters				:	[
			{title	:	"Imagens", 		extensions	:	"jpg,gif,png"},
			{title	:	"Documentos",	extensions	:	"doc,docx,xlsx,xls,pdf"}
		]
	});

	$(document).on("click", "#uploader_start", function(e)
	{
		var uploader = $('#uploader').plupload('getUploader');
		if (uploader.files.length > 0)
		{
            uploader.start();
            e.preventDefault();
    		return false;
        }
        else
		{
			alert('Adicione um arquivo para fazer upload.');
			return false;
		}
    });

	$(document).on("click", ".edit-input", function(e)
    {
	    $(this).editable(base_url + 'painel/arquivos/send_edit', { 
	        indicator	:	'<img src="'+base_url + 'assets/painel/img/loading/3.gif" />',
	        tooltip		:	"Clique para editar",
	        submitdata	:	function(value, settings) {
				return {
					rel : $(this).attr("rel")
				};
			}
	    });
    });
});
</script>