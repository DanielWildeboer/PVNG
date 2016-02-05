<!DOCTYPE html>

<html lang="nl">	
	<head>
            <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
            <meta name="description" content="Publiek Vervoer Noord-Groningen">
            <meta name="keywords" content="publiek,vervoer,noord,groningen,regio,taxi,contract">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
            <link rel="stylesheet"href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" />
            <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

            <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico?v=3" />
            
            <?php wp_head(); ?>
	</head>
	
	<body>		
		<div id="content">
			<div id="hoofdMenuContainer" class="visible-md visible-lg">
				<a href="#" class="toggle">
                                    <?php
                                        $currentPage = $_SERVER['REQUEST_URI'];
                                        if($currentPage === '/')
                                        {
                                            ?>
                                                <i class="fa fa-bars" id="mobilebtn"></i>
                                            <?php
                                        }
                                    ?>
				</a>
				<div class="container">
					<div class="row">
						<div class="col-md-3 headerlogo">
							<a href="<?= home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/headerlogo.svg" alt="..."></a>
						</div>
						<div class="col-md-6">
						</div>
						<div class="col-md-3 toggleBar">
							<a href="#" role="button" class="a11y-toggle-contrast toggle-contrast" id="is_normal_contrast" title="Keuze voor hoog contrast">
								<span class="aticon aticon-adjust" aria-hidden="true" ></span>
							</a>
							<a href="#" role="button" class="a11y-toggle-fontsize toggle-fontsize" id="is_normal_fontsize" title="Kies fontgrootte">
								<span class="aticon aticon-font" aria-hidden="true"></span>
							</a>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12 eersteMenuContainer">
							<?php 
								wp_nav_menu( array(
									'menu'				=> 'DesktopMenu',
									'container'       	=> 'div',
									'container_class' 	=> 'lijnen',
									'container_id' 		=> 'eersteLijnen',
									'menu_id'       	=> 'eersteMenuItem',
									'after' 			=> "\n <a href='#'> | </a>",
									'items_wrap'  		=> '%3$s',
									'depth'        		=> 0,
									'fallback_cb'		=> false
								));
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 tweedeMenuContainer">
							<?php 
								wp_nav_menu( array(
									'menu'				=> 'TweedeMenu',
									'container'       	=> 'div',
									'container_class' 	=> 'lijnen',
									'container_id' 		=> 'tweedeLijnen',
									'menu_id'       	=> 'tweedeMenuItem',
									'after' 			=> "\n <a href='#'> | </a>",
									'items_wrap'  		=> '%3$s',
									'depth'        		=> 0,
									'fallback_cb'		=> false
								));
							?>
						</div>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-default hidden-md hidden-lg" role="navigation">
				<div class="container">
					<div class="navbar-header">
						
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Navigatie</span>
							
							<div id="menu-knop">Menu <span class="caret"></span></div>
						</button>
						<a href="#" class="toggle">
							<i class="fa fa-bars"></i>
						</a>
						<a href="<?= home_url(); ?>" class="navbar-brand visible-xs-block visible-sm-block">
							Publiek vervoer Noord groningen
						</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<a href="#" role="button" class="a11y-toggle-contrast toggle-contrast" id="is_high_contrast" title="Keuze voor hoog contrast" aria-checked="true">
							<span class="aticon aticon-adjust" aria-hidden="true"></span>
						</a>
						<a href="#" role="button" class="a11y-toggle-fontsize toggle-fontsize" id="is_normal_fontsize" title="Kies fontgrootte">
							<span class="aticon aticon-font" aria-hidden="true"></span>
						</a>
						<?php 
							wp_nav_menu(array(
								'menu'			=> 'MobielMenu',
								'container'	 	=> false, 
								'menu_class' 	=> 'nav navbar-nav navbar-right'
								));
						?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>