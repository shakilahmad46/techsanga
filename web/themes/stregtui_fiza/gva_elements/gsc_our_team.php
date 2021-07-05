<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_our_team')):
   class gsc_our_team{

      public function render_form(){
         $fields = array(
            'type'   => 'gsc_our_team',
            'title'  => t('Our Team'), 
            'size'   => 3,
            'icon'   => 'fa fa-bars',
            'fields' => array(
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
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Photo'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
               ),
               array(
                  'id'        => 'facebook',
                  'type'      => 'text',
                  'title'     => t('Link Facebook'),
               ),
               array(
                  'id'        => 'twitter',
                  'type'      => 'text',
                  'title'     => t('Link Twitter'),
               ),
               array(
                  'id'        => 'pinterest',
                  'type'      => 'text',
                  'title'     => t('Link Pinterest'),
               ),
               array(
                  'id'        => 'google',
                  'type'      => 'text',
                  'title'     => 'Link Google'
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'options'   => array(
                     'vertical'            => 'Vertical',
                     'vertical-2'          => 'Vertical #2',
                     'horizontal'          => 'Horizontal',
                     'circle'              => 'Circle',
                     'boxed'               => 'Boxed',
                  ),
                  'title'     => t('Style'),
                  'std'       => 'vertical',
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => ('Open in new window'),
                  'desc'      => ('Adds a target="_blank" attribute to the link.'),
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
                  'sub_desc'  => t('Entrance animation'),
                  'options'   => stregtui_blockbuilder_animate()
               ),
            ),                                      
         );
         return $fields;
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_our_team( $item['fields'], $item['fields']['content'] );
      }

      public static function sc_our_team( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(  
            'image'         => '',   
            'title'         => '',
            'job'           => '',
            'content'       => '',
            'facebook'      => '',
            'twitter'       => '',
            'pinterest'     => '',
            'google'        => '',
            'style'         => 'vertical',
            'link'          => '',
            'target'        => '',
            'animate'       => '',
            'el_class'     => ''
         ), $attr));
         
         $image = substr(base_path(), 0, -1) . $image;
         
         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }

         ?>
         <?php ob_start() ?>
         <?php
         //Style display horizontal
          if($style=='horizontal'){ ?>
            <div class="widget gsc-team team-horizontal <?php print $el_class ?>">
               <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <div class="team-header">
                        <img alt="<?php print $title; ?>" src="<?php print $image; ?>" class="img-responsive"> 
                        <div class="box-hover">
                           <div class="content-inner">
                              <div class="social-list text-center">
                                 <?php if($facebook){ ?>
                                    <a href="<?php print $facebook ?>"><i class="fa fa-facebook"></i> </a>
                                 <?php } ?>
                                 <?php if($twitter){ ?>   
                                    <a href="<?php print $twitter ?>"><i class="fa fa-twitter"></i> </a>
                                 <?php } ?>
                                 <?php if($pinterest){ ?>   
                                    <a href="<?php print $pinterest ?>"><i class="fa fa-pinterest"></i> </a>
                                 <?php } ?>
                                 <?php if($google){ ?>   
                                    <a href="<?php print $google ?>"> <i class="fa fa-google"></i></a>  
                                 <?php } ?>                                             
                              </div>  
                           </div>   
                        </div>
                     </div> 
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="team-body">
                        <div class="team-body-content">
                           <h3 class="team-name">
                           <?php if($link){ ?>
                              <a href="<?php print $link; ?>" <?php print $target; ?> >
                           <?php } ?>   
                              <?php print $title ?>
                           <?php if($link){ ?> </a> <?php } ?>
                           </h3>
                           <div class="team-position"><?php print $job ?></div>
                        </div>  
                        <div class="team-info"><?php print $content ?></div>
                     </div>                            
                  </div>
               </div>
            </div>
         <?php } ?>

         <?php if($style=='vertical'){ ?>
            <div class="widget gsc-team team-vertical <?php print $el_class ?>">
               <div class="box-content">
                  <div class="frontend"><div class="images"><img alt="<?php print $title; ?>" src="<?php print $image ?>" class="img-responsive"> </div></div>
                  <div class="backend">
                     <div class="content-be">
                        <div class="be-desc">
                           <?php print $content ?>
                            <div class="social-list">
                              <?php if($facebook){ ?>
                                 <a href="<?php print $facebook ?>"><i class="fa fa-facebook"></i> </a>
                              <?php } ?>
                              <?php if($twitter){ ?>   
                                 <a href="<?php print $twitter ?>"><i class="fa fa-twitter"></i> </a>
                              <?php } ?>
                              <?php if($pinterest){ ?>   
                                 <a href="<?php print $pinterest ?>"><i class="fa fa-pinterest"></i> </a>
                              <?php } ?>
                              <?php if($google){ ?>   
                                 <a href="<?php print $google ?>"> <i class="fa fa-google"></i></a>  
                              <?php } ?>                                          
                           </div>  
                        </div>
                     </div>

                  </div>
               </div>
               <div class="team-name">
                  <a class="box-link" <?php if($link) print ('href="'.$link.'"' . $target) ?>><?php print $title ?></a>
                  <?php if($link){ ?><a class="link-action" href="<?php print $link ?>" <?php print $target ?>><?php print $text_link ?><i class="icon gv-icon-165"></i></a><?php } ?>
               </div>
               <div class="team-position"><?php print $job ?></div>
            </div>   
         <?php } ?>

         <?php if($style=='vertical-2'){ ?>
            <div class="widget gsc-team team-vertical-2 <?php print $el_class ?>">
               <div class="widget-content">
                  <div class="team-header">
                     <img alt="<?php print $title; ?>" src="<?php print $image ?>" class="img-responsive"> 
                  </div> 
                  <div class="team-body">
                     <div class="info">
                        <h3 class="team-name">
                           <?php if($link){ ?><a href="<?php print $link; ?>" <?php print $target; ?> ><?php } ?><?php print $title ?><?php if($link){ ?> </a> <?php } ?>
                        </h3>
                        <div class="team-position"><?php print $job ?></div>
                        <div class="line"></div>
                        <div class="team-content"><?php print $content ?></div>   
                     </div>            
                  </div> 
                  <div class="social-list">
                     <?php if($facebook){ ?>
                        <a href="<?php print $facebook ?>"><i class="fa fa-facebook"></i> </a>
                     <?php } ?>
                     <?php if($twitter){ ?>   
                        <a href="<?php print $twitter ?>"><i class="fa fa-twitter"></i> </a>
                     <?php } ?>
                     <?php if($pinterest){ ?>   
                        <a href="<?php print $pinterest ?>"><i class="fa fa-pinterest"></i> </a>
                     <?php } ?>
                     <?php if($google){ ?>   
                        <a href="<?php print $google ?>"> <i class="fa fa-google"></i></a>  
                     <?php } ?>                                          
                  </div>                             
               </div>
            </div>
         <?php } ?>

         <?php if($style=='circle'){ ?>
            <div class="widget gsc-team team-circle <?php print $el_class ?>">
               <div class="widget-content">
                  <div class="team-image">
                     <img alt="<?php print $title ?>" src="<?php print $image ?>" class="img-responsive"> 
                  </div> 
                  <div class="team-body">
                     <div class="info">
                        <h3 class="team-name">
                           <?php if($link){ ?>
                              <a href="<?php print $link; ?>" <?php print $target; ?> >
                           <?php } ?>  
                           <?php print $title ?>
                           <?php if($link){ ?> </a> <?php } ?>
                        </h3>
                        <p class="team-position"><?php print $job ?></p>
                        <div class="box-hover"><div class="team-content"><?php print $content ?></div></div>   
                        <div class="social-list">
                           <?php if($facebook){ ?>
                              <a href="<?php print $facebook ?>"><i class="fa fa-facebook"></i> </a>
                           <?php } ?>
                           <?php if($twitter){ ?>   
                              <a href="<?php print $twitter ?>"><i class="fa fa-twitter"></i> </a>
                           <?php } ?>
                           <?php if($pinterest){ ?>   
                              <a href="<?php print $pinterest ?>"><i class="fa fa-pinterest"></i> </a>
                           <?php } ?>
                           <?php if($google){ ?>   
                              <a href="<?php print $google ?>"> <i class="fa fa-google"></i></a>  
                           <?php } ?>                                          
                        </div>
                     </div>               
                  </div>                            
               </div>
            </div>
         <?php } ?>
         
         <?php if($style=='boxed'){ ?>
            <div class="widget gsc-team team-boxed <?php print $el_class ?>">
               <div class="widget-content text-center">
                  <div class="control-social"><i class="fa fa-plus"></i></div>
                  <div class="team-header text-center">
                     <img alt="<?php print $title; ?>" src="<?php print $image ?>" class="img-responsive"> 
                      <div class="social-list">
                        <?php if($facebook){ ?>
                           <a href="<?php print $facebook ?>"><i class="fa fa-facebook"></i> </a>
                        <?php } ?>
                        <?php if($twitter){ ?>   
                           <a href="<?php print $twitter ?>"><i class="fa fa-twitter"></i> </a>
                        <?php } ?>
                        <?php if($pinterest){ ?>   
                           <a href="<?php print $pinterest ?>"><i class="fa fa-pinterest"></i> </a>
                        <?php } ?>
                        <?php if($google){ ?>   
                           <a href="<?php print $google ?>"> <i class="fa fa-google"></i></a>  
                        <?php } ?>                                          
                     </div>  
                  </div> 
                  <div class="team-body">
                     <div class="info">
                        <h3 class="team-name">
                           <?php if($link){ ?><a href="<?php print $link; ?>" <?php print $target; ?> ><?php } ?><?php print $title ?><?php if($link){ ?> </a> <?php } ?>
                        </h3>
                        <div class="team-position"><?php print $job ?></div>
                        <div class="team-content"><?php print $content ?></div>   
                     </div>            
                  </div>                            
               </div>
            </div>
         <?php } ?>

         <?php $output = ob_get_clean(); return $output; ?>
         <?php
      }

      public function load_shortcode(){
         add_shortcode( 'our_team', array('gsc_our_team', 'sc_our_team' ));
      }
   }
endif;


