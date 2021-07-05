<?php
use Drupal\Core\Url;
function sc_blockbulider($attr){
   extract(shortcode_atts(array(
      'name'  => '',
   ), $attr));
   $_id = 'blockbulider-' . stregtui_blockbuilder_makeid();
   $output = '';
   $output .= "<div class=\"block-builder-main\" id=\"{$_id}\"><div class=\"stregtui-blockbuilder-content\">";
   	if($name){ 
   		  $results = stregtui_blockbuilder_load_by_machine($name);
        if(!$results) return '<div class="alert alert-waring">No block builder selected</div>';
        $user = \Drupal::currentUser();
        $url = \Drupal::request()->getRequestUri();
        $edit_url = '';
        if($user->hasPermission('administer stregtuiblockbuilder')){
          $edit_url = Url::fromRoute('stregtui_blockbuilder.admin.edit', array('bid' => $results->id, 'destination' =>  $url))->toString();
          $output .= "<a class=\"link-edit-blockbuider\" href=\"{$edit_url}\"> Config block builder </a>";
        }
        $output .= stregtui_blockbuilder_frontend($results->params);
        $results = null;
     	}
   $output .= "</div></div>";
   return $output;
}

add_shortcode( 'gbb','sc_blockbulider');

function sc_image($attr){
  extract(shortcode_atts(array(
    'src' => ''
  ), $attr));
  $output = '<img src="'.base_path() . $src .'" alt=""/>';
  return $output;
}

add_shortcode( 'sc_image','sc_image');