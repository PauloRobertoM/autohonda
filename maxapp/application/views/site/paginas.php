<?php
	$SITE =& get_instance();
?>

<?php include 'components/header.php'; ?>

   <section class="interna-blog interno">
      <div class="container">
         <div class="infos">
            <h1 class="titulo-geral"><?=$titulo;?></h1>
         </div><!-- .infos -->
		  <?php echo $view; ?>
      </div><!-- .container -->
   </section><!-- .interna-blog -->

<?php include 'components/footer.php'; ?>   
