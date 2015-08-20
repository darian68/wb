<?php

global $drbase_db_version;
$drbase_db_version = 20;
global $drbase_templates_option;
$drbase_templates_option = 'drbase_templates';
global $drbase_version_option;
$drbase_version_option = 'drbase_db_version';

function drbase_schema() {
	global $drbase_db_version;
    global $drbase_version_option;
    $old_db_verion = get_option( $drbase_version_option, 0 );
    if ($drbase_db_version > $old_db_verion) {
        drbase_data();
        update_option( $drbase_version_option, $drbase_db_version );
    }
}
function drbase_data() {
	global $drbase_templates_option;
    // Default regions
    $logo_region = new stdClass();
    $logo_region->key = 'logo';
    $logo_region->title = 'Logo';
    $logo_region->weight = 0;
    $logo_region->colxs = 4;
    $logo_region->colsm = 4;
    $logo_region->colmd = 12;
    $logo_region->collg = 12;
    $logo_region->custom_class = '';
    //
    $navigation_region = new stdClass();
    $navigation_region->key = 'navigation';
    $navigation_region->title = 'Navigation';
    $navigation_region->weight = 1;
    $navigation_region->colxs = 8;
    $navigation_region->colsm = 8;
    $navigation_region->colmd = 12;
    $navigation_region->collg = 12;
    $navigation_region->custom_class = '';
    //
    $page_title_region = new stdClass();
    $page_title_region->key = 'page_title';
    $page_title_region->title = 'Page Title';
    $page_title_region->weight = 0;
    $page_title_region->colxs = 12;
    $page_title_region->colsm = 12;
    $page_title_region->colmd = 12;
    $page_title_region->collg = 12;
    $page_title_region->custom_class = '';
    //
    $breadcrumbs_region = new stdClass();
    $breadcrumbs_region->key = 'breadcrumbs';
    $breadcrumbs_region->title = 'Breadcrumbs';
    $breadcrumbs_region->weight = 0;
    $breadcrumbs_region->colxs = 4;
    $breadcrumbs_region->colsm = 4;
    $breadcrumbs_region->colmd = 4;
    $breadcrumbs_region->collg = 4;
    $breadcrumbs_region->custom_class = '';
    //
    $copyright_region = new stdClass();
    $copyright_region->key = 'copyright';
    $copyright_region->title = 'Copyright';
    $copyright_region->weight = 0;
    $copyright_region->colxs = 4;
    $copyright_region->colsm = 4;
    $copyright_region->colmd = 12;
    $copyright_region->collg = 12;
    $copyright_region->custom_class = '';
    //
    $social_buttons_region = new stdClass();
    $social_buttons_region->key = 'social_buttons';
    $social_buttons_region->title = 'Social Buttons';
    $social_buttons_region->weight = 0;
    $social_buttons_region->colxs = 4;
    $social_buttons_region->colsm = 4;
    $social_buttons_region->colmd = 12;
    $social_buttons_region->collg = 12;
    $social_buttons_region->custom_class = '';
    //
    $content_region = new stdClass();
    $content_region->key = 'content';
    $content_region->title = 'Content';
    $content_region->weight = 0;
    $content_region->colxs = 12;
    $content_region->colsm = 12;
    $content_region->colmd = 12;
    $content_region->collg = 12;
    $content_region->custom_class = '';
    //
    $sidebar_region = new stdClass();
    $sidebar_region->key = 'sidebar';
    $sidebar_region->title = 'Sidebar';
    $sidebar_region->weight = 0;
    $sidebar_region->colxs = 4;
    $sidebar_region->colsm = 4;
    $sidebar_region->colmd = 4;
    $sidebar_region->collg = 4;
    $sidebar_region->custom_class = '';
    // Defaut sections
    $header_section = new stdClass();
    $header_section->key = 'header';
    $header_section->title = 'Header';
    $header_section->fullwidth = 'no';
    $header_section->weight = 0;
    $header_section->backgroundcolor = '';
    $header_section->sticky = false;
    $header_section->vphone = false;
    $header_section->vtablet = false;
    $header_section->vdesktop = false;
    $header_section->hphone = false;
    $header_section->htablet = false;
    $header_section->hdesktop = false;
    $header_section->colpadding = '';
    $header_section->custom_class = '';
    $header_section->regions = array($logo_region, $navigation_region);
    //
    $page_title_section = new stdClass();
    $page_title_section->key = 'page_title';
    $page_title_section->title = 'Page Title';
    $page_title_section->fullwidth = 'no';
    $page_title_section->weight = 1;
    $page_title_section->backgroundcolor = '';
    $page_title_section->sticky = false;
    $page_title_section->vphone = false;
    $page_title_section->vtablet = false;
    $page_title_section->vdesktop = false;
    $page_title_section->hphone = false;
    $page_title_section->htablet = false;
    $page_title_section->hdesktop = false;
    $page_title_section->colpadding = '';
    $page_title_section->custom_class = '';
    $page_title_section->regions = array($page_title_region);
    //
    $main_content_section = new stdClass();
    $main_content_section->key = 'main_content';
    $main_content_section->title = 'Main Content';
    $main_content_section->fullwidth = 'no';
    $main_content_section->weight = 2;
    $main_content_section->backgroundcolor = '';
    $main_content_section->sticky = false;
    $main_content_section->vphone = false;
    $main_content_section->vtablet = false;
    $main_content_section->vdesktop = false;
    $main_content_section->hphone = false;
    $main_content_section->htablet = false;
    $main_content_section->hdesktop = false;
    $main_content_section->colpadding = '';
    $main_content_section->custom_class = '';
    $main_content_section->regions = array($content_region);
    //
    $footer_section = new stdClass();
    $footer_section->key = 'footer';
    $footer_section->title = 'Footer';
    $footer_section->fullwidth = 'no';
    $footer_section->weight = 3;
    $footer_section->backgroundcolor = '';
    $footer_section->sticky = false;
    $footer_section->vphone = false;
    $footer_section->vtablet = false;
    $footer_section->vdesktop = false;
    $footer_section->hphone = false;
    $footer_section->htablet = false;
    $footer_section->hdesktop = false;
    $footer_section->colpadding = '';
    $footer_section->custom_class = '';
    $footer_section->regions = array($copyright_region);
    //
    $unassigned_section = new stdClass();
    $unassigned_section->key = 'unassigned';
    $unassigned_section->title = 'Unassigned';
    $unassigned_section->fullwidth = 'no';
    $unassigned_section->weight = 4;
    $unassigned_section->backgroundcolor = '';
    $unassigned_section->sticky = false;
    $unassigned_section->vphone = false;
    $unassigned_section->vtablet = false;
    $unassigned_section->vdesktop = false;
    $unassigned_section->hphone = false;
    $unassigned_section->htablet = false;
    $unassigned_section->hdesktop = false;
    $unassigned_section->colpadding = '';
    $unassigned_section->custom_class = '';
    $unassigned_section->regions = array($breadcrumbs_region, $sidebar_region, $social_buttons_region);
	$templates = array(
        array(
            'key' => 'tdefault',
            'title' => 'Template Default',
            'sections' => array ($header_section,$page_title_section,$main_content_section,$footer_section,$unassigned_section),
            'weight' => 0,
            'pages' => ''
        )
    );
    update_option( $drbase_templates_option, base64_encode(json_encode($templates)));
}
function drbase_database() {
    drbase_schema();
}
add_action("after_switch_theme", "drbase_database");