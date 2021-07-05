<?php 
namespace Drupal\stregtui_blockbuilder\shortcodes;
if(!class_exists('gsc_column_no_editor')):
   class gsc_column_no_editor{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_column_no_editor',
            'title' => t('Custom Text No Editor'),
            'size' => 3,
            'fields' => array(
               
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title'),
                   'class'     => 'display-admin'
               ),
               array(
                  'id'           => 'content',
                  'type'         => 'textarea_no_html',
                  'title'        => t('Column content'),
                  'desc'         => t('Shortcodes and HTML tags allowed.')
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
         return $fields;
      }


      public function render_content( $item ) {
         print self::sc_column_no_editor( $item['fields'] );
      }


      public static function sc_column_no_editor( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'      => '',
            'content'    => '',
            'style'      => '',
            'el_class'   => '',
            'animate'    => ''
         ), $attr));
         $el_class .= ' ' . $style;
         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $ouput = '';
         $ouput .= '<div class="column-content '.$el_class.'">';
         $ouput .= do_shortcode( $content );
         $ouput .= '</div>';
         return $ouput;
      }

      public function load_shortcode(){
         add_shortcode( 'column_no_editor', array($this, 'sc_column_no_editor') );
      }
   }
 endif;  



