<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_services_carousel')):
   class gsc_services_carousel{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_services_carousel',
            'title' => t('Services Carousel'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title For Admin'),
               ),
               array(
                  'id'     => 'height',
                  'type'      => 'text',
                  'title'     => t('Min-height of Box'),
                  'desc'      => t('e.g 220px')
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'options'   => array(
                     'style-1'     => 'Style 1',
                     'style-2'     => 'Style 2',
                     'style-3'     => 'Style 3',
                  ),
               ),
               array(
                  'id'     => 'animate',
                  'type'      => 'select',
                  'title'  => ('Animation'),
                  'desc'  => t('Entrance animation for element'),
                  'options'   => stregtui_blockbuilder_animate(),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),   
            ),                                     
         );

         for($i=1; $i<=10; $i++){
            $fields['fields'][] = array(
               'id'     => "info_${i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'text',
               'title'     => t("Title {$i}")
            );
            $fields['fields'][] = array(
               'id'           => "icon_{$i}",
               'type'         => 'text',
               'title'        => t("Icon {$i}"),
               'desc'         => t('Use class icon font <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Icon Awesome</a> or <a target="_blank" href="http://stregtuithemes.com/icons/">Custom icon</a>'),
            );
            $fields['fields'][] = array(
               'id'        => "background_{$i}",
               'type'      => 'upload',
               'title'     => t("Background {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "text_{$i}",
               'type'      => 'text',
               'title'     => t("Text {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "link_{$i}",
               'type'      => 'text',
               'title'     => t("Link {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "el_class_{$i}",
               'type'      => 'text',
               'title'     => t("El Class {$i}")
            );
         }
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_services_carousel( $item['fields'] );
      }

      public static function sc_services_carousel( $attr, $content = null ){
         global $base_url;
         $default = array(
            'title'        => '',
            'height'       => '',
            'style'        => '',
            'el_class'     => 'style-1',
            'animate'      => '',
         );

         for($i=1; $i<=10; $i++){
            $default["title_{$i}"] = '';
            $default["icon_{$i}"] = '';
            $default["background_{$i}"] = '';
            $default["text_{$i}"] = '';
            $default["link_{$i}"] = '';
            $default["el_class_{$i}"] = '';
         }

         extract(shortcode_atts($default, $attr));

         $el_class .= ' ' . $style;
         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $_id = stregtui_blockbuilder_makeid();
         $data_item_lg = 4;
         $data_item_md = 3;
         if($style=='style-3'){
            $data_item_lg = 3;
            $data_item_md = 2;
         }
         ?>
         <?php ob_start() ?>
         <div class="gsc-service-carousel <?php echo $el_class ?>"> 
            <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="<?php print $data_item_lg ?>" data-items_lg="<?php print $data_item_lg ?>" data-items_md="<?php print $data_item_md ?>" data-items_sm="2" data-items_xs="2" data-loop="1" data-speed="500" data-auto_play="1" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="1" data-rewind_nav="0" data-pagination="0" data-mouse_drag="1" data-touch_drag="1">
               <?php for($i=1; $i<=10; $i++){ ?>
                  <?php 
                     $title = "title_{$i}";
                     $icon = "icon_{$i}";
                     $link = "link_{$i}";
                     $background = "background_{$i}";
                     $text = "text_{$i}";
                     $el_classes = "el_class_{$i}";
                     $style= "";
                     if($$background){
                        $background_url = $base_url . $$background;
                        $style="background-image:url('{$background_url}')";
                     }
                  ?>
                  <?php if($$title){ ?>
                     <div class="item">
                        <div class="widget gsc-box-hover <?php print $$el_classes ?>" <?php if($height) print 'style="min-height: '.$height.'"' ?>>
                           <?php if($background){ ?><div class="background" style="<?php print $style ?>"></div><?php } ?>
                           <div class="box-content">
                              <?php if($$icon){ ?><div class="icon"><span class="<?php print $$icon ?>"></span></div> <?php } ?>
                              <div class="content">
                                 <div class="widget-title box-title">
                                    <?php if($$link){ ?><a href="<?php print $$link ?>"><?php } ?>   
                                       <?php print $$title ?>
                                    <?php if($$link){ ?></a><?php } ?>  
                                 </div>
                                 <div class="line"></div>
                                 <div class="desc"><?php print $$text ?></div>
                              </div>
                           </div>
                        </div>
                     </div>   
                  <?php } ?>    
               <?php } ?>
            </div>   
         </div>   
         <?php return ob_get_clean();
      }

      public function load_shortcode(){
         add_shortcode( 'services_carousel', array($this, 'sc_services_carousel') );
      }
   }
 endif;