<?php
//verstopt de admin balk op de site wanneer ingelogd
show_admin_bar(false);

//Zie bijbehorende functies
add_action('admin_print_styles', 'ov_admin_disable_buttons');
add_action( 'init', 'ov_footer_init' );
add_action('init', 'ov_menu');
add_action('wp_enqueue_scripts', 'ov_scripts');
add_action('init', 'ov_vragen_init');
add_action('init', 'ov_slider_init');
add_action('add_meta_boxes', 'ov_add_metabox');
add_action('save_post', 'ov_vragen_save_meta_box_data');
add_action('save_post', 'ov_slider_foto_save_meta_box_data');
add_action( 'admin_enqueue_scripts', 'ov_admin_scripts' );
add_action('post_edit_form_tag', 'ov_bestand_upload_ondersteuning');


//Hoofdmenu aanmaken
function ov_menu() 
{
	register_nav_menu('header-menu', 'Hoofdmenu');
}

function ov_admin_scripts()
{
	wp_enqueue_script('ov_vragen', get_template_directory_uri() . '/js/vragenregistreren.js', array('jquery'));
}

// Javascripts en bootstrap initialiseren
function ov_scripts() 
{
	wp_enqueue_script('general', get_template_directory_uri() . '/js/general.js', array('jquery'));
	wp_enqueue_script('jquery_ui', get_template_directory_uri() . '/js/jquery_ui.js', array('jquery'));
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
}


//ADMIN PANEL
// Voegt de verschillende custom meta boxes toe aan het admin panel gedeelte
function ov_add_metabox()
{
	add_meta_box('ov_vragen_antwoord', 'Antwoorden', 'ov_vragen_antwoord_metabox', 'vragen', 'advanced', 'high');
	add_meta_box('ov_slider_foto', 'Slider Foto', 'ov_slider_foto_metabox', 'slider', 'advanced', 'high');
}

//initeert het post type 'vragen'
function ov_vragen_init() 
{
	$args = array(
			'labels' => array(
				'name' => 'Vragen',
				'edit_item' => 'Vraag bewerken',
				'new_item' => 'Nieuwe Vraag',
				'add_new' => 'Vraag toevoegen',
				'add_new_item' => 'Nieuwe vraag toevoegen',
				'singular_name' => 'Vraag'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'vragen'),
			'supports' => array('title', 'editor')
		);

	register_post_type('vragen', $args );
}

//HTML voor in admin panel voor het vraag-antwoord gedeelte
function ov_vragen_antwoord_metabox() 
{
    global $post;
    wp_nonce_field( 'ov_vragen_antwoord_meta_box', 'ov_vragen_antwoord_noncename' );
	$ov_ja_actie = get_post_meta($post->ID,'ov_ja_actie',true);
	$ov_nee_actie = get_post_meta($post->ID,'ov_nee_actie',true);
	$ov_ja_value = get_post_meta($post->ID,'ov_ja_value',true);
	$ov_nee_value = get_post_meta($post->ID,'ov_nee_value',true);
	
	echo '<b>Ja actie:</b><br />';
	echo '<input onclick="v1()" type="radio" name="ov_ja_actie" id="ov_ja_vraag" value="vraag" '; 
	if($ov_ja_actie == "vraag")
	{
		echo 'checked';
	}
	echo '/> Vraag<br /><input onclick="v2()" type="radio" name="ov_ja_actie" id="ov_ja_pagina" value="pagina" '; 
	if($ov_ja_actie == "pagina")
	{
		echo 'checked';
	}
	echo '/> Pagina<br />';
	echo '<div id="ja_pagina" class="ov_ja_actie"><textarea rows="5" class="textarea" name="ov_ja_pagina">' . esc_attr( $ov_ja_value ) . '</textarea></div>';
	getVragenSelect("ov_ja_vraag", "ja_vraag", "ov_ja_actie", esc_attr( $ov_ja_value ));
	echo '<b>Nee actie:</b><br />';
	echo '<input onclick="v3()" type="radio" name="ov_nee_actie" id="ov_nee_vraag" value="vraag" ';
	if($ov_nee_actie == "vraag")
	{
		echo 'checked';
	}
	echo '/> Vraag<br />
		<input onclick="v4()" type="radio" name="ov_nee_actie" id="ov_nee_pagina" value="pagina"';
	if($ov_nee_actie == "pagina")
	{
		echo 'checked';
	}
	echo '/> Pagina<br />';
	echo '<div id="nee_pagina" class="ov_nee_actie"><textarea rows="5" class="textarea" name="ov_nee_pagina">' . esc_attr( $ov_nee_value ) . '</textarea></div>';
	getVragenSelect("ov_nee_vraag", "nee_vraag", "ov_nee_actie", esc_attr( $ov_nee_value ));
	echo '<style type="text/css"> .textarea{ resize: none; width: 100%; }</style>';
}

function getVragenSelect($name, $id, $class, $value)
{
	echo '<div id="' . $id . '" class="' . $class . '"><select name="'. $name .'">';
	$type = 'vragen';
	$args=array(
	  'post_type' => $type);

	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) 
	{
	  while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<option value="<?php echo get_the_id() . '"';if($value == get_the_id()){echo ' selected';}?>><?php echo get_the_title();?></option>
		<?php
	  endwhile;
	}
	
	echo '</select></div><br />';
	
	wp_reset_query();
}

function ov_vragen_save_meta_box_data( $post_id ) 
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    if ( !isset( $_POST['ov_vragen_antwoord_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['ov_vragen_antwoord_noncename'], 'ov_vragen_antwoord_meta_box' ) )
        return;
	
	if(isset($_POST['ov_ja_actie']) && isset($_POST['ov_nee_actie']))
	{
		$ov_ja_actie = $_POST['ov_ja_actie'];
		$ov_nee_actie = $_POST['ov_nee_actie'];
		$ov_nee_string = "";
		$ov_ja_string = "";
		
		if($ov_ja_actie == 'vraag')
		{
			$ov_ja_value = $_POST['ov_ja_vraag'];
			$ov_ja_string = 'toonVraag(' . $_POST["ov_ja_vraag"] . ')';
		}
		else
		{
			$ov_ja_value = $_POST['ov_ja_pagina'];
			$ov_ja_string = 'showHTML(\"' . htmlentities(preg_replace( "/\r|\n/", "", $_POST["ov_ja_pagina"])) . '\")';
		}
		
		if($ov_nee_actie == 'vraag')
		{
			$ov_nee_value = $_POST['ov_nee_vraag'];
			$ov_nee_string = 'toonVraag(' . $_POST["ov_nee_vraag"] . ')';
		}
		else
		{
			$ov_nee_value = $_POST['ov_nee_pagina'];
			$ov_nee_string = 'showHTML(\"' . htmlentities(preg_replace( "/\r|\n/", "", $_POST["ov_nee_pagina"])) . '\")';
		}
		
		update_post_meta($post_id,'ov_ja_actie', $ov_ja_actie);
		update_post_meta($post_id,'ov_nee_actie', $ov_nee_actie);
		update_post_meta($post_id,'ov_ja_value', $ov_ja_value);
		update_post_meta($post_id,'ov_nee_value', $ov_nee_value);
		update_post_meta($post_id,'ov_ja_string', $ov_ja_string);
		update_post_meta($post_id,'ov_nee_string', $ov_nee_string);
	}
}

//Footer blokken initialiseren
function ov_footer_init() {
	$args = array(
			'labels' => array(
				'name' => 'Footerblokken',
				'edit_item' => 'Footerblok bewerken',
				'singular_name' => 'Footerblok'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'footer'),
			'supports' => array('title', 'editor')
		);

	register_post_type('footer', $args );
}

//initeert het post type 'slider' voor de slider op de homepage
function ov_slider_init() 
{
	$args = array(
			'labels' => array(
				'name' => 'Sliderfoto',
				'edit_item' => 'Sliderfoto bewerken',
				'new_item' => 'Nieuwe Sliderfoto',
				'add_new' => 'Sliderfoto toevoegen',
				'add_new_item' => 'Nieuwe Sliderfoto toevoegen',
				'singular_name' => 'Sliderfoto'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider'),
			'supports' => array('title', 'editor')
		);

	register_post_type('slider', $args );
}

//HTML voor de sliderfoto
function ov_slider_foto_metabox() 
{
    wp_nonce_field('ov_slider_foto_meta_box', 'ov_slider_foto_noncename');
     
    $html = '<p class="description">';
    $html .= 'Upload de sliderfoto hier, het moet een JPG, GIF of PNG bestand zijn.';
    $html .= '</p>';
    $html .= '<input type="file" id="ov_slider_foto" name="ov_slider_foto" value="" size="25" />';
     
    echo $html;
}

//Slider foto opslaan
function ov_slider_foto_save_meta_box_data( $post_id ) 
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    if ( !isset( $_POST['ov_slider_foto_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['ov_slider_foto_noncename'], 'ov_slider_foto_meta_box' ) )
        return;
	
	
	// Standaard checks uitgevoerd, nu bezig met het echte opslaan
    if(!empty($_FILES['ov_slider_foto']['name'])) 
	{
		//checks om te kijken of het wel een ondersteund foto formaat is.
        $arr_bestands_type = wp_check_filetype(basename($_FILES['ov_slider_foto']['name']));
        $echte_type = $arr_bestands_type['type'];
         
        if(in_array($echte_type, array('image/gif')) || in_array($echte_type, array('image/png')) || in_array($echte_type, array('image/jpeg'))) 
		{
            // Upload het bestand via Wordpress
            $upload = wp_upload_bits($_FILES['ov_slider_foto']['name'], null, file_get_contents($_FILES['ov_slider_foto']['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) 
			{
                wp_die('Er is iets fout gegaan tijdens het uploaden <br /> Error:' . $upload['error']);
            } 
			else
			{
				//voeg het bestand toe
                add_post_meta($post_id, 'ov_slider_foto', $upload);
                update_post_meta($post_id, 'ov_slider_foto', $upload);     
            }
 
        } 
		else 
		{
            wp_die("Dat type bestand wordt niet ondersteund, het moet een JPG, GIF of PNG bestand zijn.");
        }
         
    }
}



//Verstopt bepaalde elementen in het admin paneel
function ov_admin_disable_buttons() 
{
	global $submenu;
	unset($submenu['edit.php?post_type=footer'][10]);
	
	// Verstopt de berichten posttype links en de grote nieuw knop in de admin bar
	echo '<style type="text/css">#wp-admin-bar-new-content, #menu-posts{display: none !important;} </style>';
	
	// Verstopt footerblokken toevoeg knoppen en delete knop wanneer category footerblokken wordt bekeken
	if (isset($_GET['post_type']) && $_GET['post_type'] == 'footer') {
		echo '<style type="text/css"> #favorite-actions, .add-new-h2, .tablenav { display:none; }</style>';
		echo '<style type="text/css"> .submitdelete{ display:none; }</style>';
	}
	// Verstopt footerblokken toevoeg knoppen en delete knop wanneer een van de footerblokken posts wordt bekeken
	if (isset($_GET['post'])) 
	{
		if ($_GET['post'] == '151' || $_GET['post'] == '152' || $_GET['post'] == '153' || $_GET['post'] == '154' || $_GET['post'] == '155' ) 
		{
			echo '<style type="text/css"> #favorite-actions, .add-new-h2, .tablenav { display:none; } .submitdelete, .deletion{ display:none; } #minor-publishing{ display:none; }</style>';
		}
	}
}

//Zorgt voor bestands upload ondersteuning voor de slider
function ov_bestand_upload_ondersteuning() 
{
    echo ' enctype="multipart/form-data"';
}
?>