<?php
	$this->CI =& get_instance();
	$this->CI->load->library('ckeditor');

	$nameform	=	"albuns";	
?>
	<link href="<?php echo base_url('assets/painel/js/jquery-libs/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css'); ?>" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url('assets/painel/js/jquery-libs/plupload/plupload.full.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/painel/js/jquery-libs/plupload/jquery.ui.plupload/jquery.ui.plupload.js'); ?>"></script>
	<div class="row-fluid">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo site_url('painel/home'); ?>">Home</a>
				<span class="divider">/</span>
			</li>
			<li>
				<a href="<?php echo site_url('painel/'.$nameform); ?>">Álbuns de fotos</a>
				<span class="divider">/</span>
			</li>
			<li class="active">Listagem dos álbuns do sistema</li>
		</ul>
	</div>

	<div class="row-fluid">
		<div class="widget widget-padding">
			<div class="widget-header">
				<i class="icon-search"></i>
				<h5>Pesquisa</h5>
				<div class="widget-buttons">
					<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Ver todos" class="tip"><i class="icon-list"></i> </a>
					<a href="javascript:void(0);" data-title="Clique" data-collapsed="true" class="collapse tip widget-hidden"><i class="icon-chevron-up"></i> </a>
				</div>
			</div>
			<div class="widget-body" style="display:none;">
				<?php
					echo form_open(site_url('painel/'.$nameform), array('autocomplete'=>'off', 'class'=>'form-horizontal'));
					$data = (get_post("data")) ? show_data_time(get_post("data")) : "";
				?>
				<div class="control-group">
					<label class="control-label">Criada em:</label>
					<div class="controls">
						<input name="data" class="span10 datetimepicker focused" type="text" value="<?php echo $data; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Titulo:</label>
					<div class="controls">
						<input name="titulo" class="span10 focused" type="text" value="<?php echo get_post("titulo"); ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Crédito:</label>
					<div class="controls">
						<input name="credito" class="span10 focused" type="text" value="<?php echo get_post("credito"); ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"> </label>
                	<div class="controls">
                		<button id="button_action" class="btn btn-primary btn-large span10" type="submit">Pesquisar</button>
                	</div>
                </div>
				<?php
					echo form_close();
				?>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="widget widget-padding">
			<div class="widget-header">
				<i class="icon-picture"></i>
				<h5>Álbuns de fotos</h5>
				<div class="widget-buttons">
					<?php
						if($this->Model_modulos->check_actions('add', $nameform) === TRUE) {
					?>
							<a href="javascript:void(0);" class="tip" data-title="Adicionar" data-toggle="modal" data-target="#albuns_modal"><i class="icon-plus"></i></a>
					<?php
						}
					?>
					<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
				</div>
			</div>
			<div class="widget-body">
				<table class="table" id="tbl">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>TITULO</th>
							<th>CREDITO</th>
							<th class="action">AÇÕES</th>
						</tr>
					</thead>
					<tbody class="item_list_content">
						<?php
							if(count($lista) > 0)
							{
								foreach($lista as $items)
								{
						?>
									<tr id="i_<?php echo $items['id']; ?>" class="multiplus">
										<td><?php echo $items['id']; ?></td>
										<td class="edit-input" id="<?php echo $items['id']; ?>" rel="data" title="Duplo clique para editar"><?php echo $items['data']; ?></td>
										<td class="edit-input" id="<?php echo $items['id']; ?>" rel="titulo" title="Duplo clique para editar"><?php echo $items['titulo']; ?></td>
										<td class="edit-input" id="<?php echo $items['id']; ?>" rel="credito" title="Duplo clique para editar"><?php echo $items['credito']; ?></td>
										<td class="action">
											<?php
												if($this->Model_modulos->check_actions('upd', $nameform) === TRUE) {
													echo btn_status(array("nameform"=>$nameform, "id"=>$items['id'], "title"=>status($items['status'], 'info'), "img"=>status($items['status'], 'image')));												
												}
												echo btn_editar(array("nameform"=>$nameform, "id"=>$items['id'], "page"=>$page, "title"=>"Editar", "img"=>"paint_brush"));
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
	</div>


	<div id="albuns_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Álbum de fotos</h3>
		</div>
		<div class="modal-body">
			<form class="form-inline" id="album">
				<div class="control-group">
					<label class="control-label">Data</label>
					<div class="input-append date datepicker datepicker-basic" data-date="" data-date-format="dd/mm/yyyy">
						<input class="span3" name="data" size="16" type="text" value="">
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
					<label class="control-label">Titulo</label>
					<input name="titulo" class="span4" type="text" value="" />
					<label class="control-label">Crédito</label>
					<input name="credito" class="span4" type="text" value="" />
				</div>
				<div class="control-group" id="container">
					<div id="uploader"></div>
					<textarea name="conteudo" id="conteudo" rows="5"><?php echo $res['conteudo']; ?></textarea>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button id="uploadfiles" class="btn btn-primary">Salvar</button>
		</div>
	</div>


	<script type="text/javascript">
		var base_url	=	'<?php echo base_url(); ?>';
		var user_id		=	'<?php echo session('uid'); ?>';
		var site_url	=	'<?php echo site_url('painel/'.$nameform); ?>';
        CKEDITOR.replace('conteudo');

		$(function()
		{
			$("#uploader").plupload({
				runtimes			:	'gears,html5,browserplus',
				browse_button		:	'pickfiles',
				container			:	'container',
				max_file_size		:	'10mb',
				autostart			:	false,
				sortable			:	true,
				rename				:	true,
				dragdrop			:	true,
				url					:	site_url + "/do_uploads",
				filters				:	[
					{title	:	"Image files",	extensions	:	"jpg,gif,png"},
					{title	:	"Zip files",	extensions	:	"zip"}
				],
				views: {
					list	:	false,
					thumbs	:	true,
					active	:	'thumbs'
				}
			});

			$(document).on("click", "#uploadfiles", function(e)
			{
				var uploader	=	$('#uploader').plupload('getUploader');
				$("#uploadfiles").html('Aguarde').removeClass("btn-primary").addClass("btn-danger");
				if(uploader.files.length > 0)
				{
					uploader.bind('StateChanged', function()
					{
						if(uploader.files.length === (uploader.total.uploaded + uploader.total.failed))
						{						
								
							var dados = $('#album').serialize();
							
							$.ajax({
								type		:	"POST",
								url			:	site_url + "/save",
								//data		:	{data:$("input[name=data]").val(), titulo:$("input[name=titulo]").val(), credito:$("input[name=credito]").val(), conteudo:CKEDITOR.instances['conteudo'].getData()},
								data		:	dados,
								cache		:	false,
								dataType	:	"json",
								success		:	function(html)
								{
									if(html)
									{
										var table	=	null;
										table   +=	'<tr id="i_' + html.id + '" class="multiplus">';
										table  	+=		'<td>' + html.id + '</td>';
										table	+=		'<td class="edit-input" id="' + html.id + '" rel="data" title="Duplo clique para editar">' + html.data + '</td>';
										table	+=		'<td class="edit-input" id="' + html.id + '" rel="titulo" title="Duplo clique para editar">' + html.titulo + '</td>';
										table	+=		'<td class="edit-input" id="' + html.id + '" rel="credito" title="Duplo clique para editar">' + html.credito + '</td>';
										table  	+=		'<td class="action">';
										table  	+=			'<a href="javascript:void(0);" id="' + html.id + '" rel="albuns" class="btn btn-mini tip status" title="Ativar">';
										table  	+=				'<img src="' + base_url + 'assets/painel/img/icons/dark/minus.png">';
										table  	+=			'</a> ';
										table  	+=			'<a href="' + site_url + '/upd/' + html.id + '/0" class="btn btn-mini tip" title="Editar">';
										table  	+=				'<img src="' + base_url + 'assets/painel/img/icons/dark/paint_brush.png">';
										table  	+=			'</a> ';
										table  	+=			' <a href="javascript:void(0);" id="' + html.id + '" class="btn btn-mini tip del" rel="albuns" data-original-title="Excluir">';
										table  	+=				'<img src="' + base_url + 'assets/painel/img/icons/dark/trashcan.png">';
										table  	+=			'</a>';
										table  	+=		'</td>';
										table	+=	'</tr>';
										$(document).find('tbody.item_list_content').find('tr:first').before(table);
									}
								},
								complete	:	function(data)
								{
									uploader.splice();
									$(document).find('#uploader_filelist').html('');
									$(document).find('input[name=data]').val('');
									$(document).find('input[name=titulo]').val('');
									$(document).find('input[name=credito]').val('');
									CKEDITOR.instances['conteudo'].setData('');
									$("#uploadfiles").html('Salvo').removeClass("btn-danger").addClass("btn-primary");
									$('div#albuns_modal').modal('hide');
								}
							});								
							
						}
					});

					uploader.start();
				}
				else
				{
					alert("Selecione os arquivos...!");
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