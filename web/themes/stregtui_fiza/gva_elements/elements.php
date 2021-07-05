<?php
function stregtui_blockbuilder_get_elements(){
   return $shortcodes = array(
    'gsc_accordion',
    'gsc_box_hover', 
    'gsc_box_info',
    'gsc_box_text',
    'gsc_call_to_action',
    'gsc_chart',
    'gsc_code',
    'gsc_column',
    'gsc_column_no_editor',
    'gsc_counter',
    'gsc_drupal_block',
    'gsc_heading',
    'gsc_icon_box',
    'gsc_image',
    'gsc_our_team',
    'gsc_pricing_item',
    'gsc_progress',
    'gsc_tabs',
    'gsc_video_box',
    'gsc_gmap',
    'gsc_button',
    'gsc_view',
    'gsc_quote_text',
    'gsc_work_process',
    'gsc_image_content',
    'gsc_services_carousel',
    'gsc_our_history',
    'gsc_our_contact',
    'gsc_gallery',
    'gsc_our_partners',
    'gsc_download',
    'gsc_socials',
    'gsc_instagram',
    'gsc_carousel_content',
    'gsc_divider',
    'gsc_testimonial_single',
    'gsc_timeline',
    'gsc_view_tabs_ajax',
    'gsc_contact_info'
  );
}

function scrape_insta_hash($tag) {
   $insta_source = file_get_contents('https://www.instagram.com/'.trim($tag)); // instagrame tag url
   $shards = explode('window._sharedData = ', $insta_source);
   $insta_json = explode(';</script>', $shards[1]); 
   $insta_array = json_decode($insta_json[0], TRUE);
   return $insta_array; // this return a lot things print it and see what else you need
}