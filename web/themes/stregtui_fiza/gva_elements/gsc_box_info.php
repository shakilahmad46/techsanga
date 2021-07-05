<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_box_info')):
   class gsc_box_info{
      public function render_form(){
         return array(
           'type'          => 'gsc_box_info',
            'title'        => t('Box Info Background'),
            'size'         => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Image'),
                  'desc'      => t('Image for box info'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Content for box info'),
               ),
               array(
                  'id'        => 'height',
                  'type'      => 'text',
                  'title'     => t('Min height'),
                  'desc'      => t('Min height for content info box. e.g. 300px'),
               ),
               array(
                  'id'        => 'content_align',
                  'type'      => 'select',
                  'title'     => t('Content Align'),
                  'desc'      => t('Align Content for box info'),
                  'options'   => array( 'left' => 'Left', 'right' => 'Right' ),
                  'std'       => 'left'
               ),
               array(
                  'id'        => 'content_color',
                  'type'      => 'select',
                  'title'     => t('Skin content'),
                  'desc'      => t('Skin color for text content'),
                  'options'   => array( 'dark' => 'Dark', 'light' => 'Light'  ),
                  'std'       => 'left'
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'link_title',
                  'type'      => 'text',
                  'title'     => t('Link Title'),
                  'std'       => 'Read more'
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 'off' => 'No', 'on' => 'Yes' ),
                  'std'       => 'on'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),                                     
         );
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
            print self::sc_box_info( $item['fields'], $item['fields']['content'] );
      }

      public static function sc_box_info( $attr, $content = null ){
         global $base_url, $base_path;
         extract(shortcode_atts(array(
            'title'              => '',
            'image'              => '',
            'height'             => '1px',
            'content_align'      => '',
            'content_color'      => 'dark',
            'link'               => '',
            'link_title'         => 'Readmore',
            'target'             => '',
            'el_class'           => ''
         ), $attr));

         // target
         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         if($image) $image = substr($base_path, 0, -1) . $image;

         ?>
         <?php ob_start(); ?>
            <div class="widget gsc-box-info <?php print $el_class ?> content-align-<?php print $content_align ?>" <?php if($height) print ('style="min-height:' . $height . '"'); ?>>
               <div class="box-row">
                  <div class="image box-column"><div class="content-inner text-center"><div class="column-content-inner">
                     <img src="<?php print $image ?>" alt="<?php print $title ?>" />
                  </div></div></div> 
                  <div class="box-content box-column text-<?php print $content_color ?>">
                     <div class="content-inner">
                        <div class="column-content-inner">
                           <?php if($title){ ?>
                              <h2 class="title"><?php print $title; ?></h2>
                            <?php } ?>      

                           <?php if($content){ ?>
                              <div class="desc"><?php print $content; ?></div>
                           <?php } ?>   

                           <?php if($link){ ?>
                              <div class="readmore"><a class="btn-theme btn btn-sm" href="<?php print $link ?>"><?php print $link_title ?></a></div>
                           <?php } ?>
                        </div>   
                     </div>
                  </div>
               </div>   
           </div>
         <?php return ob_get_clean(); ?>
      <?php
      } 

      public function load_shortcode(){
         add_shortcode( 'box_info', array($this, 'sc_box_info'));
      }
   }
endif;   
