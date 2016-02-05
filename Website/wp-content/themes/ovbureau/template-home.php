<?php 
/*
Template Name: Homepage
*/

get_header(); ?>
<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/vragenlijst.js"></script>-->
<div id="jumboHeader" class="jumbotron">
    <div id="vraagContainer" class="well col-md-2 col-sm-12 col-xs-12 vraagBox">
        <h3 id="vraagTitel"></h3>
        <div class="vraagTekstContainer">
            <p id="vraagTekst"></p>
        </div>
        <div id="jaNeeGroup" class="col-md-12 col-sm-12 col-xs-12 ">
            <div id="jaAntwoordMain" class="col-md-6 col-sm-6 col-xs-6 ">
                <button id="jaAntwoord" type="button" class="btn btn-success">Ja</button>
            </div>
            <div id="neeAntwoordMain" class="col-md-6 col-sm-6 col-xs-6 ">
                <button id="neeAntwoord" type="button" class="btn btn-danger">Nee</button>
            </div>
        </div>
    </div>

        <div id="frame">            
            <iframe class ="col-md-12 col-sm-12 col-xs-12" src="./wp-content/themes/ovbureau/map.php"></iframe>
        </frame>
    
	<div id="menu" class="well col-md-1 col-sm-12 col-xs-12 ">

		<div id="taxi" class="col-md-12 col-sm-12 col-xs-12 ">
			<div id="oranjec" class="col-md-6 col-sm-6 col-xs-6 ">
				<i class="fa fa-circle-o fa-2x"></i>
			</div>
			<div id="taxiText" class="col-md-6 col-sm-6 col-xs-6 ">
				<p>Taxi</p>
			</div>
		</div>
		<div id="bus" class="col-md-12 col-sm-12 col-xs-12 ">
			<div id="blauwc" class="col-md-6 col-sm-6 col-xs-6 ">
				<i class="fa fa-circle-o fa-2x"></i>
			</div>
			<div id="busText" class="col-md-6 col-sm-6 col-xs-6 ">
				<p>Bus</p>
			</div>
		</div>
		<div id="trein" class="col-md-12 col-sm-12 col-xs-12 ">
			<div id="groenc" class="col-md-6 col-sm-6 col-xs-6 ">
				<i class="fa fa-circle-o fa-2x"></i>
			</div>
			<div id="treinText" class="col-md-6 col-sm-6 col-xs-6 ">
				<p>Trein</p>
			</div>
		</div>
		<div id="auto" class="col-md-12 col-sm-12 col-xs-12 ">
			<div id="roodc" class="col-md-6 col-sm-6 col-xs-6 ">
				<i class="fa fa-circle-o fa-2x"></i>
			</div>
			<div id="autoText" class="col-md-6 col-sm-6 col-xs-6 ">
				<p>Auto</p>
			</div>
		</div>
	</div>
		</div>
 	<div class="jumbotron jumboContent">
	<div class="container">
		<div class="row">			
			<div class="col-md-6">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); 	?>
					<article class="post">
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
</div>
<script>

	jQuery(document).ready(function()
	{
            //slider menu rechts
            jQuery('.toggle').click(function()
            {           
                if(jQuery('#menu').is(':hidden') && jQuery('#vraagContainer').is(':hidden'))
                {
                    jQuery('#menu').show('slide',{direction:'right'}, 1000);
                    jQuery('#vraagContainer').show('slide',{direction:'left'}, 1000);
                } 
                else 
                {
                    jQuery('#menu').hide('slide',{direction:'right'}, 1000);
                    jQuery('#vraagContainer').hide('slide',{direction:'left'}, 1000);                   
                }
            });
            
            
		jQuery('input[type = "radio"][class = "radionavi"]').change(function () 
		{
			this.checked = false;
		});
		resizeDiv();
	});
	window.onresize = function(event) 
	{
		resizeDiv();
	}
	
	resizeDiv();
	
	function resizeDiv() 
	{
		blok1h = jQuery('.nieuwsblok1').height();
		blok2h = jQuery('.nieuwsblok2').height();
		blok3h = jQuery('.nieuwsblok3').height();
		blok4h = jQuery('.nieuwsblok4').height();
		vpw = jQuery(window).width();
		vph = jQuery(window).height();
		if(vpw >= 768)
		{
			jQuery('#busline1').css({'height': blok1h + 'px'});
			jQuery('#busline2').css({'height': blok2h + 'px'});
			jQuery('#busline3').css({'height': blok3h + 'px'});
			jQuery('#busline4').css({'height': blok4h + 'px'});
			
			jQuery('.radionavi1').css({'margin-top': ((blok1h - 100) /6) + 'px'});
			jQuery('.radionavi2').css({'margin-top': ((blok2h - 100) /6) + 'px'});
			jQuery('.radionavi3').css({'margin-top': ((blok3h - 100) /6) + 'px'});
			jQuery('.radionavi4').css({'margin-top': ((blok4h - 100) /6) + 'px'});
		}
	}	
	
	//callen die bijbehorende scroll functie hieronder wanneer er op een nieuws blok wordt geklikt.
	jQuery("#home-blok1").click(function () {scrollNaarNieuws(1)});
	jQuery("#home-blok2").click(function () {scrollNaarNieuws(2)});
	jQuery("#home-blok3").click(function () {scrollNaarNieuws(3)});
	jQuery("#home-blok4").click(function () {scrollNaarNieuws(4)});
	
	//scrollt naar bovenin de pagina
	function scrollNaarTop()
	{
		jQuery('html, body').animate(
		{
			scrollTop: jQuery("#content").offset().top
		}, 1000);
	}
	//scrollt naar nieuws blok 1,2,3 of 4 (int)
	function scrollNaarNieuws(i)
	{
		jQuery('html, body').animate(
		{
			scrollTop: jQuery(".nieuwsblok" + i).offset().top
		}, 1000);
	}
	
	//vragenlijst
	jQuery( document ).ready(function() 
	{
		jQuery("#vraagTitel").html(vragen[157].vraagTitel);
		jQuery("#vraagTekst").html(vragen[157].vraagTekst);
		jQuery("#jaAntwoord").attr("onclick", vragen[157].jaActieValue);
		jQuery("#neeAntwoord").attr("onclick", vragen[157].neeActieValue);
	});

	function toonVraag(id)
	{
	jQuery("#vraagTitel").html(vragen[id].vraagTitel);
	jQuery("#vraagTekst").html(vragen[id].vraagTekst);
	jQuery("#jaAntwoord").attr("onclick", vragen[id].jaActieValue);
	jQuery("#neeAntwoord").attr("onclick", vragen[id].neeActieValue);
	}

	function showHTML(id)
	{
	jQuery("#vraagContainer").html(decodeHtml(id) + "<button onclick='resetHTML()'>Ga terug</button>");
	}
	
	function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
	}

	function resetHTML()
	{
	jQuery("#vraagContainer").html('<h1 id="vraagTitel"></h1>' +
		'<p id="vraagTekst"></p>' +
		'<div id="jaNeeGroup">' +
			'<div class="btn-group" role="group" aria-label="...">' + 
				'<button id="jaAntwoord" type="button" class="btn btn-success">Ja</button>' +
				'<button id="neeAntwoord" type="button" class="btn btn-danger">Nee</button>' +
			'</div>' +
		'</div>');
	toonVraag(157);
	}
	var vragen = {
	
	<?php $loop = new WP_Query( array( 'post_type' => 'vragen') ); ?>
	<?php while ( $loop->have_posts()) : $loop->the_post(); ?>
		'<?php echo get_the_ID() ?>':{
		vraagID:<?php echo get_the_ID() ?>,
		vraagTitel:"<?php echo get_the_title()?>",
		vraagTekst:"<?php echo get_the_content()?>",
		jaActieValue:'<?php echo get_post_meta( get_the_ID(), 'ov_ja_string', true )?>',
		neeActieValue:'<?php echo get_post_meta( get_the_ID(), 'ov_nee_string', true )?>'
		},	
	<?php endwhile; wp_reset_query(); ?>
	
	};
</script>

<?php get_footer(); ?>