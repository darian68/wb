<?php
// DYNAMIC TEMPLATES
global $selected_template;
$selected_template = new stdClass();
// Custom template tags
function drbase_renderRegion($region) {
    global $post;
    $key = $region->key;
    switch ($key) {
    // default region
    case "logo":
        ?><div class="region logo"></div><?php
        break; // get logo from theme option
    case "navigation":
        $nav = array(
            'theme_location'  => '',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'region nmenu',
            'container_id'    => 'navigation',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        );
        wp_nav_menu( $nav );
        break;
    case "page_title":
        if (have_posts()) : while (have_posts()) : the_post(); ?>			
		<div class="page-title region"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
        <?php endwhile; ?>		
	    <?php endif;?> <?php
    case "breadcrumbs":
        ?><div class="region breadcrumbs"></div><?php
        break;
    case "copyright":
        ?><div class="region copyright"></div><?php
        break;
    case "social_buttons":
        ?><div class="region social_buttons"></div><?php
        break;
    case "content":
        if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="content region"> <?php the_content(); ?> </div>
        <?php endwhile; ?>		
	    <?php endif;?> <?php
        break;
    case "sidebar":
        get_sidebar();
        break;
    // custom region
    default:
        ?><div class="custom-region region"></div><?php
        break;
    }
}
function get_custom_page_templates() {
  $templates = array();
  // maybe by options? --> $templates = get_option( 'custom_page_templates' );
  // maybe by conf file? --> $templates = include 'custom_page_templates.php';
  return apply_filters( 'custom_page_templates', $templates );
}
add_action( 'edit_form_after_editor', 'custom_page_templates_init' );
add_action( 'load-post.php', 'custom_page_templates_init_post' );
add_action( 'load-post-new.php', 'custom_page_templates_init_post' );

function custom_page_templates_init() {
  remove_action( current_filter(), __FUNCTION__ );
  if ( is_admin() && get_current_screen()->post_type === 'page' ) {
    $templates = get_custom_page_templates(); // the function above
    if ( ! empty( $templates ) )  {
      set_custom_page_templates( $templates );
    }
  }
}

function custom_page_templates_init_post() {
  remove_action( current_filter(), __FUNCTION__ );
  $method = filter_input( INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING );
  if ( empty( $method ) || strtoupper( $method ) !== 'POST' ) return;
  if ( get_current_screen()->post_type === 'page' ) {
    custom_page_templates_init();
  }
}
function set_custom_page_templates( $templates = array() ) {
  if ( ! is_array( $templates ) || empty( $templates ) ) return;
  $core = array_flip( (array) get_page_templates() ); // templates defined by file
  $data = array_filter( array_merge( $core, $templates ) );
  ksort( $data );
  $stylesheet = get_stylesheet();
  $hash = md5( get_theme_root( $stylesheet ) . '/' . $stylesheet );
  $persistently = apply_filters( 'wp_cache_themes_persistently', false, 'WP_Theme' );
  $exp = is_int( $persistently ) ? $persistently : 1800;
  wp_cache_set( 'page_templates-' . $hash, $data, 'themes', $exp );
}
add_filter( 'custom_page_templates', function( $now_templates ) {
    global $drbase_templates_option;
    $encoded_serialized_templates = get_option( $drbase_templates_option, '');
    $templates = json_decode(base64_decode($encoded_serialized_templates));
    $dynamic_templates = array();
    foreach ($templates as $template) {
        $dynamic_templates[$template->key] = $template->title;
    }
    $dynamic_templates['customtemplate'] = 'Custom template';
  return array_merge( $now_templates, $dynamic_templates );
} );
add_filter( 'template_include', 'drbase_page_template', 99 );

function drbase_page_template( $template ) {
	global $post;
    global $drbase_templates_option;
    $encoded_serialized_templates = get_option( $drbase_templates_option, '');
    $templates = json_decode(base64_decode($encoded_serialized_templates));
    //if ($post->post_type == 'page') {}
    renderTemplate(get_page_template_slug( $post->ID ));
    if (get_page_template_slug( $post->ID ) != '') die;
    return $template;
}
function renderTemplate($template_slug) {
    global $drbase_templates_option, $selected_template;
    $encoded_serialized_templates = get_option( $drbase_templates_option, '');
    $templates = json_decode(base64_decode($encoded_serialized_templates));
    foreach ($templates as $template) {
        if ($template->key == $template_slug){
            $selected_template = $template;
            $sections = $template->sections;
            foreach ($sections as $section) {
                drbase_renderSection($section);
            }
            break;
        }
    }
}
function drbase_renderSection($section) {
    global $post;
    $key = $section->key;
    switch ($key) {
    // Default section
    case "header":
        get_header();
        break;
    case "page_title":
    case "main_content":
        ?><div class="section"><?php
        foreach ($section->regions as $region) {
            drbase_renderRegion($region);
        }
        ?></div><?php
        break;
    case "footer":
        get_footer();
        break;
    case "unassigned":
        // Ignore this section
        break;
    // Custom section
    default:
        ?><div class="section custom-section"><?php
        foreach ($section->regions as $region) {
            drbase_renderRegion($region);
        }
        ?></div><?php
        break;
    }
}
// Add menu
add_action( 'admin_menu', 'drbase_layout_menu' );

function drbase_layout_menu(){
    // Template
    add_menu_page( 'Templates', 'Templates', 'manage_options', 'dynamic-templates', 'drbase_layout_menu_page','dashicons-admin-appearance', 61 );
    // Theme options
    add_submenu_page( 'themes.php', "Theme Options", "Theme Options", 'manage_options', 'theme-options', 'drbase_layout_theme_options');
}
// Add 'Theme Options' node to the 'site-name'.
add_action( 'admin_bar_menu', 'drbase_add_node', 999 );
function drbase_add_node( $wp_admin_bar ) {
	$args = array(
		'id'     => 'theme-options',     // id of the existing child node (New > Post)
		'title'  => 'Theme Options', // alter the title of existing node
		'parent' => 'site-name',
        'href'   => 'themes.php?page=theme-options'
	);
	$wp_admin_bar->add_node( $args );
}
function drbase_enqueue_script($hook) {
    if ( 'toplevel_page_dynamic-templates' != $hook ) {
        return;
    }
    wp_enqueue_style( 'drbase-bootstrap-style', get_bloginfo('template_directory') . '/css/bootstrap.css');
    wp_enqueue_style( 'drbase-font-awesome-style', get_bloginfo('template_directory') .'/fonts/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style( 'drbase-admin-style', get_bloginfo('template_directory') . '/css/admin.drbase.css');
    wp_enqueue_style( 'ui.dialog.style', '/wp-includes/css/jquery-ui-dialog.css');
    //wp_enqueue_style( 'ui.button.style', '/wp-includes/css/jquery-ui-button.css');
    
    wp_enqueue_script( 'ui.core', '/wp-includes/js/jquery/ui/jquery.ui.core.min.js', true);
    wp_enqueue_script( 'ui.widget', '/wp-includes/js/jquery/ui/jquery.ui.widget.min.js', true);
    wp_enqueue_script( 'ui.mouse', '/wp-includes/js/jquery/ui/jquery.ui.mouse.min.js', true);
    wp_enqueue_script( 'ui.draggable', '/wp-includes/js/jquery/ui/jquery.ui.draggable.min.js', true);
    wp_enqueue_script( 'ui.dropable', '/wp-includes/js/jquery/ui/jquery.ui.droppable.min.js' , true);
    wp_enqueue_script( 'ui.sortable', '/wp-includes/js/jquery/ui/jquery.ui.sortable.min.js' , true);
    wp_enqueue_script( 'ui.dialog', '/wp-includes/js/jquery/ui/jquery.ui.dialog.min.js' , true);
    wp_enqueue_script( 'ui.button', '/wp-includes/js/jquery/ui/jquery.ui.button.min.js' , true);
    wp_enqueue_script( 'ui.position', '/wp-includes/js/jquery/ui/jquery.ui.position.min.js' , true);
    wp_enqueue_script( 'drbase', get_bloginfo('template_directory') . '/js/templates_drag_drop.js', true);
}
add_action( 'admin_enqueue_scripts', 'drbase_enqueue_script' );
function drbase_layout_menu_page() {
    global $drbase_templates_option;
    //Save templates
    if (isset($_POST["drbase_templates"])) {
        $option_value = $_POST["drbase_templates"];
        update_option( $drbase_templates_option, $option_value);
        //die;
    }
    // Load templates
    $encoded_serialized_templates = get_option( $drbase_templates_option, '');
    //var_dump($encoded_serialized_templates);
    $templates = base64_decode($encoded_serialized_templates);
    //var_dump($templates);
    $sections = array('header','banner');
	$sections = json_encode($sections);
	$js = <<<JS
	var dexp_layouts = {$templates};
	var dexp_sections = {$sections};
	var dexp_regions = {$sections};
JS;
?>
<script>
    <?php echo $js;?>
</script>
<?php
    include_once( ADMIN_PATH . 'front-end/templates.php' );
}
function drbase_layout_theme_options() {
    include_once( ADMIN_PATH . 'front-end/options.php' );
}