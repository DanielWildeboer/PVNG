<?php 
/**
 * Index Template
 *
 *
 * @file           index.php
 * @package        ovbureau
 * @author         INF2H
 */

get_header(); ?>
<div id="jumboHeader2" class="jumbotron">
	<div class="container">
		<div class="row">
		</div>
	</div>
</div>

<div class="container content">
	<div class="row">			
		<div class="col-md-12">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); 	?>
				<article class="post">
					<div class="the-content">
						<h3><?php echo get_the_title(); ?></h3>
						<?php echo get_the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<article class="post error">
				<h1 class="404">Pagina kan niet worden gevonden!</h1>
			</article>
		<?php endif; ?>
		</div>
	</div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>!-->
<script>
 
	jQuery(document).ready(function()
	{
		jQuery(".tweedeMenuContainer").hide();
		jQuery( "a:contains('Aangepast Vervoer')" ).click(function() {
			toggleTweedeMenu();
		});
		
		jQuery('input[type = "radio"][class = "radionavi"]').change(function () 
		{
			this.checked = false;
		});
	});

	function toggleTweedeMenu()
	{
		if(jQuery(".tweedeMenuContainer").is(":visible"))
		{
			jQuery(".tweedeMenuContainer").hide();
		}
		else
		{
			jQuery(".tweedeMenuContainer").show();
		}
	}
</script>

<?php get_footer(); ?>