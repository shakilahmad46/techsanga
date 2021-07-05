<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_our_contact')):
   class gsc_our_contact{
      public function render_form(){
         return array(
           'type'          => 'gsc_our_contact',
            'title'        => t('Box Our Contact'),
            'size'         => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'address',
                  'type'      => 'text',
                  'title'     => t('Address'),
               ),
               array(
                  'id'        => 'email',
                  'type'      => 'text',
                  'title'     => t('Email'),
               ),
               array(
                  'id'        => 'telephone',
                  'type'      => 'text',
                  'title'     => t('Telephone'),
               ),
               array(
                  'id'        => 'work_hours',
                  'type'      => 'text',
                  'title'     => t('Work Hours'),
               ),
               array(
                  'id'        => 'additional_information',
                  'type'      => 'textarea',
                  'title'     => t('Additional Information'),
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
            print self::sc_our_contact( $item['fields'], $item['fields']['content'] );
      }

      public static function sc_our_contact( $attr, $content = null ){
         global $base_url, $base_path;
         extract(shortcode_atts(array(
            'title'                    => '',
            'address'                  => '',
            'email'                    => '',
            'telephone'                => '',
            'work_hours'               => '',
            'additional_information'   => '',
            'el_class'                 => ''
         ), $attr));
         ?>

         <?php ob_start(); ?>

            <div class="widget gsc-our-contact <?php print $el_class ?>">
               <div class="widget-content">
                  <?php if($address){ ?>
                     <div class="item-info">
                        <div class="icon"><i class="gv-icon-1138"></i></div>
                        <div class="info-content">
                           <span class="title"><?php print t('Address') ?></span><span class="text"><?php print $address ?></span>
                        </div>
                     </div>
                  <?php } ?>
                  <?php if($email){ ?>
                     <div class="item-info">
                        <div class="icon"><i class="gv-icon-236"></i></div>
                        <div class="info-content">
                           <span class="title"><?php print t('E-Mail') ?></span><span class="text"><?php print $email ?></span>
                        </div>
                     </div>
                  <?php } ?>
                  <?php if($telephone){ ?>
                     <div class="item-info">
                        <div class="icon"><i class="gv-icon-266"></i></div>
                        <div class="info-content">
                           <span class="title"><?php print t('Telephone') ?></span><span class="text"><?php print $telephone ?></span>
                        </div>
                     </div>
                  <?php } ?>
                  <?php if($work_hours){ ?>
                     <div class="item-info">
                        <div class="icon"><i class="gv-icon-1111"></i></div>
                        <div class="info-content">
                           <span class="title"><?php print t('Work Hours') ?></span><span class="text"><?php print $work_hours ?></span>
                        </div>
                     </div>
                  <?php } ?>
                  <?php if($additional_information){ ?>
                     <div class="item-info">
                        <div class="icon"><i class="gv-icon-10"></i></div>
                        <div class="info-content">
                           <span class="title"><?php print t('Additional Information') ?></span><div class="text"><?php print $additional_information ?></div>
                        </div>
                     </div>
                  <?php } ?>
               </div>   
           </div>

         <?php return ob_get_clean(); ?>
      <?php
      } 

      public function load_shortcode(){
         add_shortcode( 'our_contact', array($this, 'sc_our_contact'));
      }
   }
endif;   
