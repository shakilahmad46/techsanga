<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_timeline')):
   class gsc_timeline{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_timeline',
            'title' => t('Timeline'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'class'     => 'display-admin',
                  'title'  => t('Title For Admin'),
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
               'id'        => "time_{$i}",
               'type'      => 'text',
               'title'     => t("Time {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "content_{$i}",
               'type'      => 'text',
               'title'     => t("Content {$i}")
            );
         }
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_timeline( $item['fields'] );
      }

      public static function sc_timeline( $attr, $content = null ){
         global $base_url;
         $default = array(
            'title'      => '',
            'el_class'   => '',
            'animate'    => '',
         );

         for($i=1; $i<=10; $i++){
            $default["time_{$i}"] = '';
            $default["content_{$i}"] = '';
         }

         extract(shortcode_atts($default, $attr));

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $_id = stregtui_blockbuilder_makeid();
         
         ?>
         <?php ob_start() ?>
         <div class="gsc-timeline <?php echo $el_class ?>"> 
            <div class="owl-carousel init-carousel-owl owl-loaded owl-drag" data-items="4" data-items_lg="4" data-items_md="3" data-items_sm="2" data-items_xs="2" data-loop="1" data-speed="500" data-auto_play="1" data-auto_play_speed="2000" data-auto_play_timeout="5000" data-auto_play_hover="1" data-navigation="1" data-rewind_nav="0" data-pagination="0" data-mouse_drag="1" data-touch_drag="1">
               <?php for($i=1; $i<=10; $i++){ ?>
                  <?php 
                     $time = "time_{$i}";
                     $content = "content_{$i}";
                  ?>
                  <?php if($$time){ ?>
                     <div class="item"><div class="content-inner text-center">
                     <?php if($$time){ ?><div class="time"><span class="line"></span><?php print $$time ?></div><?php } ?>         
                     <?php if($$content){ ?><div class="box-content"><div class="inner"><?php print $$content ?></div></div><?php } ?>
                     </div></div>
                  <?php } ?>    
               <?php } ?>
            </div>  
         </div>   

         <?php return ob_get_clean();
      }

      public function load_shortcode(){
         add_shortcode( 'timeline', array($this, 'sc_timeline') );
      }
   }
 endif;  



