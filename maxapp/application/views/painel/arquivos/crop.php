<?php
	$this->CI =& get_instance();

	$nameform	=	"arquivos";
	$imagesize	=	getimagesize("_ups/arquivos/" . $res["folder"] . "/" . $res["arquivo"]);
?>
<div class="row-fluid">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo site_url('painel/home'); ?>">Home</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="<?php echo site_url('painel/'.$nameform); ?>">Redimensionamento de Arquivos</a>
			<span class="divider">/</span>
		</li>
	</ul>
</div>
<div class="row-fluid">
	<div class="widget span9">
		<div class="widget-header">
			<i class="icon-fullscreen"></i>
			<h5>Redimensionamento de Arquivos</h5>
			<div class="widget-buttons">
				<a href="<?php echo site_url('painel/'.$nameform); ?>" data-title="Voltar para a lista" class="tip"><i class="icon-list"></i> </a>
				<a href="javascript:void(0);" class="info-help-crop"><i class="icon-question-sign"></i> </a>
			</div>
		</div>
		<div class="widget-body">
			<img src="_ups/arquivos/<?php echo $res["folder"] . "/" . $res["arquivo"]; ?>" id="cropbox" />
			<form id="from_crop">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="x2" name="x2" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="y2" name="y2" />
				<input type="hidden" id="h" name="h" />
				<input type="hidden" id="w" name="w" />
			</form>
		</div>
	</div>
	<div class="widget span3">
		<div class="widget-header">
			<i class="icon-lightbulb"></i>
			<h5>Preview</h5>
		</div>
		<div style="width:330px; height:320px; clear:both;" class="widget-body clearfix">
			<div style="float:left; position:relative; overflow:hidden; width:100px; height:100px;">
				<img src="_ups/arquivos/<?php echo $res["folder"] . "/" . $res["arquivo"]; ?>" id="preview" />
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="http://www.webmotionuk.co.uk/jquery/js/jquery-pack.js"></script>
<script type="text/javascript" src="http://www.webmotionuk.co.uk/jquery/js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript">
	$(window).load(function () { 
		$('#cropbox').imgAreaSelect({
			aspectRatio		:	'1:1',
			onSelectChange	:	preview,
			handles			:	true
		}); 
	});

	function preview(img, selection)
	{
		var scaleX = 100 / (selection.width || 1); 
		var scaleY = 100 / (selection.height || 1); 

		$('#preview').css({ 
			width: Math.round(scaleX * <?php echo $imagesize[0]; ?>) + 'px', 
			height: Math.round(scaleY * <?php echo $imagesize[1]; ?>) + 'px',
			marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
			marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
		});

		$('#x1').val(selection.x1);
		$('#y1').val(selection.y1);
		$('#x2').val(selection.x2);
		$('#y2').val(selection.y2);
		$('#w').val(selection.width);
		$('#h').val(selection.height);
	}
</script>