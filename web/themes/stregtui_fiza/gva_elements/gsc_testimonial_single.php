<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_testimonial_single')):
   class gsc_testimonial_single{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_testimonial_single',
            'title' => ('Testimonial single'), 
            'size' => 3,'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Name'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'job',
                  'type'      => 'text',
                  'title'     => t('Job'),
               ),
               array(
                  'id'        => 'avatar',
                  'type'      => 'upload',
                  'title'     => t('Avatar'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Some Shortcodes and HTML tags allowed'),
               ),
                array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => 'Style',
                  'options'   => array(
                     'style-1'   => t('Style #1'), 
                     'style-2'   => t('Style #2'),
                     'style-3'   => t('Style #3'),
                     'style-4'   => t('Style #4'),
                     'style-5'   => t('Style #5'),
                  ) 
               ),
               array(
                  'id'        => 'skin_text',
                  'type'      => 'select',
                  'title'     => 'Skin Text for box',
                  'options'   => array(
                     'text-dark'  => t('Text Dark'), 
                     'text-light' => t('Text Light')
                  ) 
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => stregtui_blockbuilder_animate(),
               ), 
               array(
                  'id'     => 'el_class',
                  'type'      => 'text',
                  'title'  => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),

            ),                                       
         );
         return $fields;
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_testimonial_single( $item['fields'], $item['fields']['content'] );
      }


      public static function sc_testimonial_single( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(
            'title'           => '',
            'job'             => '',
            'avatar'          => '',
            'skin_text'       => '',
            'style'           => 'style-1',
            'el_class'        => '',
            'animate'         => ''
         ), $attr));

         $class = array();
         if($el_class) $class[] = $el_class;
         if($skin_text) $class[] = $skin_text;
         if($animate){
            $class[] = 'wow';
            $class[] = $animate;
         }
         $class[] = $style;
         if($avatar){
            $avatar = $base_url . $avatar;
         }
         ?>
         <?php ob_start() ?>
         
         <?php if($style == 'style-1'): ?>
            <div class="widget gsc-testimonial-single <?php if(count($class)>0) print implode($class, ' ') ?>">
               <div class="box-content">
                  <div class="right">
                     <?php if($content){ ?><div class="quote"><?php print $content; ?></div><?php } ?> 
                  </div>
                  <div class="left">
                     <div class="content-inner">
                        <?php if($avatar){ ?>
                           <div class="avatar"><img src="<?php print $avatar ?>" alt="<?php print $title ?>" /></div>
                        <?php } ?>
                        <div class="info">
                           <?php if($title){ ?><div class="title"><?php print $title; ?></div><?php } ?>  
                           <?php if($job){ ?><div class="job"><?php print $job; ?></div><?php } ?>   
                        </div>
                     </div>   
                  </div>
               </div>
            </div>
         <?php endif ?>
         
         <?php if($style == 'style-2' || $style=='style-3'): ?>
            <div class="widget gsc-testimonial-single <?php if(count($class)>0) print implode($class, ' ') ?>">
               <div class="box-content">
                  <div class="left">
                     <div class="content-inner">
                        <?php if($avatar){ ?>
                           <div class="avatar"><img src="<?php print $avatar ?>" alt="<?php print $title ?>" /></div>
                        <?php } ?>
                        <div class="info">
                           <?php if($title){ ?><div class="title"><?php print $title; ?></div><?php } ?>  
                           <?php if($job){ ?><div class="job"><?php print $job; ?></div><?php } ?>   
                        </div>
                     </div>   
                  </div>
                  <div class="right">
                     <?php if($content){ ?><div class="quote"><?php print $content; ?></div><?php } ?> 
                  </div>   
               </div>
            </div> 
         <?php endif ?>

         <?php if($style == 'style-4'): ?>
            <div class="widget gsc-testimonial-single <?php if(count($class)>0) print implode($class, ' ') ?>">
               <div class="box-content">
                  <div class="right">
                     <?php if($content){ ?><div class="quote"><?php print $content; ?></div><?php } ?> 
                  </div> 
                  <div class="left">
                     <div class="content-inner">
                        <?php if($avatar){ ?>
                           <div class="avatar"><img src="<?php print $avatar ?>" alt="<?php print $title ?>" /></div>
                        <?php } ?>
                        <div class="info">
                           <?php if($title){ ?><div class="title"><?php print $title; ?></div><?php } ?>  
                           <?php if($job){ ?><div class="job"><?php print $job; ?></div><?php } ?>   
                        </div>
                     </div>   
                  </div>
               </div>
            </div> 
         <?php endif ?>

         <?php if($style == 'style-5'): ?>
            <div class="widget gsc-testimonial-single <?php if(count($class)>0) print implode($class, ' ') ?>">
               <div class="box-content">
                  <div class="left">
                     <div class="content-inner">
                        <?php if($avatar){ ?>
                           <div class="avatar"><img src="<?php print $avatar ?>" alt="<?php print $title ?>" /></div>
                        <?php } ?>
                        <div class="info">
                           <?php if($title){ ?><div class="title"><?php print $title; ?></div><?php } ?>  
                           <?php if($job){ ?><div class="job"><?php print $job; ?></div><?php } ?>   
                        </div>
                     </div>   
                  </div>
                  <div class="right">
                     <?php if($content){ ?><div class="quote"><?php print $content; ?></div><?php } ?> 
                  </div>   
               </div>
            </div>
         <?php endif ?>

         <?php return ob_get_clean() ?>
       <?php
      }

      public function load_shortcode(){
         add_shortcode( 'testimonial_single', array($this, 'sc_testimonial_single') );
      }
   } 
endif;   
