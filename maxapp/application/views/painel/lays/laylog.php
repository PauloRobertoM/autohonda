<?php
	$this->CI =& get_instance();
	echo doctype('xhtml1-trans');
?>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel | <?php echo $this->CI->config->item('titulo_sistema', 'settings'); ?></title>
		<?php
			echo meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
			echo meta(array('name' => 'robots', 'content' => 'noindex, nofollow'));
			echo meta(array('name' => 'author', 'content' => 'Maxmeio'));
			echo meta(array('name' => 'description', 'content' => 'no-cache'));
			echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');

			echo link_tag(base_url().'assets/painel/css/bootstrap.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/theme.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/font-awesome.min.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/alertify.css', 'stylesheet', '', '', '');
			echo link_tag('http://fonts.googleapis.com/css?family=Open+Sans:400,700', 'stylesheet', '', '', '');
		?>

		<!-- link rel="shortcut icon" href="assets/ico/favicon.ico" -->
		<!-- link rel="Favicon Icon" href="favicon.ico"-->

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="wrap">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<?php echo $contents; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery-ui-1.9.2.custom.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/bootstrap.js"></script>
		<script type="text/javascript" src='<?php echo base_url(); ?>assets/painel/js/sparkline.js'></script>
		<script type="text/javascript" src='<?php echo base_url(); ?>assets/painel/js/morris.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.facybox.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.alertify.min.js"></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.gritter.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/scripts/login.js"></script>
	</body>
</html>