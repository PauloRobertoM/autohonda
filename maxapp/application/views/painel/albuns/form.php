<?php
	$this->CI =& get_instance();
	$this->CI->load->library('ckeditor');

	$msg_header	=	(is_null($id)) ? "Cadastro de álbuns do sistema" : "Atualização de álbuns do sistema";
	$nameform	=	"albuns";
	$pagina		=	(is_null($pagination)) ? 0 : $pagination ;
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
		<li class="active"><?php echo $msg_header; ?></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h5>Álbuns de fotos</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform.'/'.$pagina); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" data-title="Abrir/Fechar" data-collapsed="false" class="collapse tip"><i class="icon-chevron-up"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<?php
				echo form_open(NULL, array('id'=>'form_'.$nameform, 'autocomplete'=>'off', 'class'=>'form-horizontal'));
				echo form_hidden(array('id'=>$id, 'pagination'=>$pagina));
			?>
				<div class="control-group">
					<label class="control-label">Data</label>
					<div class="controls form-inline">
						<div class="input-append date datepicker datepicker-basic" data-date="<?php echo show_data($res['data']); ?>" data-date-format="dd/mm/yyyy">
							<input name="data" size="16" type="text" value="<?php echo show_data($res['data']); ?>">
							<span class="add-on"><i class="icon-th"></i></span>
                        </div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Titulo</label>
					<div class="controls">
					<code>Este campo é <b>obrigatório</b></code><br />
						<input name="titulo" class="span7" type="text" value="<?php echo $res['titulo']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Crédito</label>
					<div class="controls">
						<input name="credito" class="span7" type="text" value="<?php echo $res['credito']; ?>" style="width:80%;" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Conteúdo</label>
					<div class="controls">
						<code>Este campo é <b>obrigatório</b>. | Após colar de um arquivo WORD, selecione todo o conteúdo e utilize a ferramenta <b>[Borracha]</b>.</code><br />
						<textarea name="conteudo" id="conteudo" rows="5"><?php echo $res['conteudo']; ?></textarea>
				        <?php //echo $this->CI->ckeditor->run('wysiwyg'); ?>
					</div>
                </div>
                <div class="control-group">
                	<div class="controls">
                		<button id="button_action" class="btn btn-primary btn-large btn-block span10" type="submit">Enviar</button>
                	</div>
                </div>
			</form>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="widget widget-padding">
		<div class="widget-header">
			<i class="icon-picture"></i>
			<h5>Fotos</h5>
			<div class="widget-buttons">
				<?php
					if($this->Model_modulos->check_actions('add', $nameform) === TRUE) {
				?>
						<a href="javascript:void(0);" class="tip" data-title="Adicionar" data-toggle="modal" data-target="#albuns_modal"><i class="icon-plus"></i></a>
				<?php
					}
				?>
			</div>
		</div>
		<div class="widget-body" id="containers">
			<div id="uploaders">
				<div class="plupload_wrapper">
					<div class="ui-widget-content plupload_container ui-resizable plupload_view_thumbs">
						<div class="plupload_content">
							<ul class="plupload_filelist_content" unselectable="off">
								<?php
									if(count($arquivos_albuns) > 0)
									{
										foreach($arquivos_albuns['lista'] as $files)
										{
											$cor_destaque = ($files['destaque'] == 1) ? "#f00" : "#000" ;
								?>
									<li class="ui-state-default plupload_file" style="width:114px; overflow:visible;" id="<?php echo $files['id']; ?>">
										<div class="plupload_file_thumb plupload_file_thumb_loaded">
											<img src="<?php echo "_ups/arquivos/" . $files['folder'] . "/" . $files['arquivo']; ?>" width="100" height="60" />
										</div>
										<div class="plupload_file_action" style="width:41px;">
											<a href="javascript:void(0);" class="tip-bottom deletefiles" data-title="Excluir" id="<?php echo $files['id']; ?>" style="color:#000; font-size:14px;">
												<div class="icon-remove-circle"> </div>
											</a>
											<a href="javascript:void(0);" class="tip-bottom destacafiles" data-title="Destaque" rel="<?php echo $files['album_id']; ?>" id="<?php echo $files['id']; ?>" style="color:<?php echo $cor_destaque; ?>; font-size:14px;">
												<i class="icon-pushpin"></i>
											</a>
										</div>
										<div class="plupload_file_size"><?php echo show_file_size("_ups/arquivos/" . $files['folder'] . "/" . $files['arquivo']); ?>|<?php echo $files['id']; ?></div>
									</li>
								<?php
										}
									}
								?>
							</ul>
							<div class="plupload_clearer">&nbsp;</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="albuns_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:510px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Fotos</h3>
	</div>
	<div class="modal-body">
		<form class="form-inline">
			<div class="control-group" id="container">
				<div id="uploader" style="width:100%;"></div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		<button id="uploadfiles" class="btn btn-primary">Enviar</button>
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
			},
		    preinit : {
				UploadFile: function(up, file) {
					up.settings.multipart_params = {'action':'update', 'id_post':'<?php echo $id; ?>'};
				}
			}
		});

		$(document).on("click", "#uploadfiles", function(e)
		{
			var uploader = $('#uploader').plupload('getUploader');
			if(uploader.files.length > 0)
			{
				uploader.bind('StateChanged', function()
				{
					if(uploader.files.length === (uploader.total.uploaded + uploader.total.failed))
					{
						window.location.reload();
					}
				});

				uploader.start();
			}
			else
			{
				alert("Selecione os arquivos...!");
			}
		});


		$(document).on("click", "a.deletefiles", function(e)
		{
			if(confirm("Deseja excluir esta foto?"))
			{
				var id			=	$(this).attr('id');

				$.ajax({
					type		:	"POST",
					url			:	site_url + "/delfiles",
					data		:	{id:id},
					cache		:	false,
					dataType	:	"json",
					success : function(e)
					{
						$(document).find("li#" + id).fadeOut("fast").remove();
					}
				});
		    }
		});


		$(document).on("click", "a.destacafiles", function(e)
		{
			if(confirm("Deseja destacar esta foto?\n\rApenas uma foto poderá ser destaque."))
			{
				var _this		=	$(this);
				var id			=	_this.attr('id');
				var rel			=	_this.attr('rel');

				$.ajax({
					type		:	"POST",
					url			:	site_url + "/destacafiles",
					data		:	{id:id, rel:rel},
					cache		:	false,
					dataType	:	"json",
					beforeSend	:	function(e)
					{
						$("a.destacafiles").each(function(i)
						{
							$(this).css({"color":"#000"});
						});
					},
					success		:	function(e)
					{
						_this.css({"color":"#f00", "font-size":"14px"});
						alertify.log('Concluído com sucesso!', 'success');
					}
				});
		    }
		});

	});
</script>