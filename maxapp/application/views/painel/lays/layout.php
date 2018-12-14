<?php
	$this->CI =& get_instance();
	echo doctype('xhtml1-trans');

	$var_modules = array();
	foreach($this->CI->show_grupos() as $grupos)
	{
		foreach($grupos['modulos'] as $modules)
		{
			$var_modules[$grupos['id']][] = $modules['url'];
		}
	}
?>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo base_url('painel'); ?>" rel="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel | <?php echo $this->CI->config->item('titulo_sistema'); ?></title>
		<?php
			echo meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
			echo meta(array('name' => 'robots', 'content' => 'noindex, nofollow'));
			echo meta(array('name' => 'author', 'content' => 'Maxmeio'));
			echo meta(array('name' => 'description', 'content' => 'no-cache'));
			echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');

			echo link_tag(base_url().'assets/painel/css/bootstrap.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/js/jquery-libs/Jcrop/css/jquery.Jcrop.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/js/jquery-libs/fancybox/dist/jquery.fancybox.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/theme.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/font-awesome.min.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/alertify.css', 'stylesheet', '', '', '');
			echo link_tag('http://fonts.googleapis.com/css?family=Open+Sans:400,700', 'stylesheet', '', '', '');
			echo link_tag('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/prettyphoto-style.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/style.css', 'stylesheet', '', '', '');

			echo link_tag(base_url().'assets/painel/css/colorpicker.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/redactor/css/redactor.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/datepicker.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/timepicker.css', 'stylesheet', '', '', '');
			echo link_tag(base_url().'assets/painel/css/select2.css', 'stylesheet', '', '', '');
		?>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery-ui-1.9.2.custom.js"></script>
		<!-- script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.ui.datepicker.js"></script-->
		<!-- script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.ui.timepicker.js"></script-->
		<!-- script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.ui.timepicker-addon.js"></script-->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/redactor/redactor.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/raphael-min.js"></script>
		<script type="text/javascript" src='<?php echo base_url(); ?>assets/painel/js/sparkline.js'></script>
		<script type="text/javascript" src='<?php echo base_url(); ?>assets/painel/js/morris.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.imagesloaded.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.facybox.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.alertify.min.js"></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.gritter.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.knob.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.livequery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.maskedinput.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.maskMoney.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.prettyPhoto.js"></script>
		<?php if(!isset($form_album)){ ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.simplemodal.js"></script>
        <? } ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/bootstrap-colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/select2.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/scripts/script-forms.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/scripts/script-full.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/painel/js/jquery-libs/jquery.slimscroll.min.js"></script>

		<!-- link rel="shortcut icon" href="assets/ico/favicon.ico" -->
		<!-- link rel="Favicon Icon" href="favicon.ico"-->

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        
	</head>
	<body>
		<div id="wrap">
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">
						<div class="logo"> 
							<img src="<?php echo path_painel_assets('img/marca.png'); ?>" alt="<?php echo $this->CI->config->item('titulo_sistema'); ?>" height="20">
						</div>
						<a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="btn btn-navbar slide_menu_left visible-tablet">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="top-menu visible-desktop">
							<ul class="pull-right">
								<li><a href="<?php echo site_url('painel/logout'); ?>"><i class="icon-off"></i> Sair</a></li>
							</ul>
						</div>
						<div class="top-menu visible-phone visible-tablet">
							<ul class="pull-right">
								<?php if(session("setor_id") <= 0) { ?>
									<li><a title="Clique para ver as Mensagens" href="javascript:void(0);"><i class="icon-envelope"></i></a></li>
								<?php } ?>
								<li><a href="<?php echo site_url('painel/logout'); ?>"><i class="icon-off"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="sidebar-nav nav-collapse collapse">
					<div class="user_side clearfix">
						<img src="<?php echo path_painel_assets('img/icons/header/user-icon3.png'); ?>" alt="<?php echo $this->session->userdata("nome"); ?>">
						<h5><?php echo word_limiter($this->session->userdata("nome"), 1); ?></h5>
          				<a href="<?php echo site_url('painel/config'); ?>"><i class="icon-cog"></i> Configuração</a>        
					</div>
					<div class="accordion" id="accordion2">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle active b_F79999" href="<?php echo site_url('painel/home'); ?>"><span>Home</span></a>
							</div>
						</div>
						<?php
							// core/MY_Controller.php
							foreach($this->CI->show_grupos() as $grupos)
							{
								if(in_array($this->CI->uri->segment(2), $var_modules[$grupos['id']])) {
									$active_in		=	"in";
									$colapsed		=	"";
									$styleheight	=	"style='height:auto;'";
								} else {
									$active_in		=	"";
									$colapsed		=	"collapsed";
									$styleheight	=	"style='height:0;'";										
								}
						?>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle b_C3F7A7 <?php echo $colapsed; ?>" data-toggle="collapse" data-parent="#accordion2" rel="<?php echo "#" . $grupos['url']; ?>">
									<span><?php echo ucfirst($grupos['titulo']); ?></span>
								</a>
							</div>
							<div id="<?php echo $grupos['url']; ?>" class="accordion-body <?php echo $active_in; ?> collapse" <?php echo $styleheight; ?>>
								<div class="accordion-inner">
									<?php
										foreach($grupos['modulos'] as $modules)
										{
											if(in_array($this->CI->uri->segment(2), $modules)) {
												$active	=	'active';
											} else {
												$active	=	NULL;
											}

											echo '<a class="accordion-toggle in '.$active.'" href="'.site_url('painel/'.$modules['url']).'">'.$modules['titulo'].'</a>';
										}
									?>
								</div>
							</div>
						</div>
						<?php
							}
	                    ?>
					</div>
				</div>

				<div class="main_container" id="dashboard_page">
					<?php echo $contents; ?>
				</div>

				<div id="form-modal">
					<div class="row-fluid">
						<div class="widget widget-padding">
							<div class="widget-header">
								<i class="icon-edit"></i>
								<h5>Novo registro</h5>
								<div class="widget-buttons">
									<a href="javascript:void(0);" data-collapsed="false" class="collapse"><i class="icon-chevron-up"></i> </a>
								</div>
							</div>
							<div id="content-body">
								<div class="widget-body">
									<p></p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</body>
</html>