<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_box_hover')):
   class gsc_box_hover{
      
      public function render_form(){
         $fields = array(
            'type'            => 'gsc_box_hover',
            'title'           => t('Box Hover'),
            'size'            => 3,
            'icon'            => 'fa fa-bars',
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => 'Title for box',
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content for box'),
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Background Image'),
                  'std'       => '',
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'text_link',
                  'type'      => 'text',
                  'title'     => t('Text Link'),
               ),
               array(
                  'id'        => 'height',
                  'type'      => 'text',
                  'title'     => t('Min-height of Box'),
                  'desc'      => t('e.g 220px')
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 0 => 'No', 1 => 'Yes' ),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation'),
                  'options'   => stregtui_blockbuilder_animate(),
               ),
            ),                                     
         );
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_box_hover( $item['fields'] );
      }

      public static function sc_box_hover( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(
            'icon'               => '',
            'title'              => '',
            'content'            => '',
            'link'               => '',
            'text_link'          => 'Read more',
            'height'             => '',
            'image'              => '',
            'target'             => '',
            'el_class'           => '',
            'animate'            => ''
         ), $attr));

         if($image) $image = $base_url . $image; 
         
         // target
         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $style = '';
         if($height) $style .= "min-height:{$height};";
         if($style) $style = "style=\"{$style}\"";
         ?>
         <?php ob_start() ?>
         <div class="widget gsc-box-hover clearfix <?php print $el_class; ?>" <?php if($style) print $style ?>>
            <div class="box-content">
               <div class="frontend"><div class="background" style="background-image:url('<?php print $image ?>')"></div></div>
               <div class="backend">
                  <div class="content-be">
                     <div class="be-desc"><?php print $content ?></div>
                  </div>
               </div>
            </div>
            <div class="box-title">
               <a class="box-link" <?php if($link) print ('href="'.$link.'"' . $target) ?>><?php print $title ?></a>
               <?php if($link){ ?><a class="link-action" href="<?php print $link ?>" <?php print $target ?>><?php print $text_link ?><i class="icon gv-icon-165"></i></a><?php } ?>
            </div>
         </div>  
         <?php return ob_get_clean() ?>
         <?php
      }

      public function load_shortcode(){
         add_shortcode( 'box_hover', array($this, 'sc_box_hover') );
      }
   }
endif;   




