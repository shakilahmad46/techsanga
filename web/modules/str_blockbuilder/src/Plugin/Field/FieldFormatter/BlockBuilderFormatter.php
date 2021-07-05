<?php

/**
 * Plugin implementation of the 'Block Builder' formatter.
 *
 * @FieldFormatter(
 *   id = "blockbuilder_formatter",
 *   label = @Translation("Block Builder"),
 *   field_types = {
 *     "blockbuilder"
 *   }
 * )
 */

namespace Drupal\stregtui_blockbuilder\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Url;

class BlockBuilderFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $bid = !empty($item->bid) ? $item->bid : 0;
      $content = '';
      if($bid){
        $results = stregtui_blockbuilder_load($bid);
        if(!$results){
          $content = t('No block builder selected');
        }else{
          $user = \Drupal::currentUser();
          $url = \Drupal::request()->getRequestUri();
          $edit_url = '';
          if($user->hasPermission('administer stregtuiblockbuilder')){
            $edit_url = Url::fromRoute('stregtui_blockbuilder.admin.edit', array('bid' => $bid, 'destination' =>  $url))->toString();
          }

          $content .= '<div class="stregtui-blockbuilder-content">';
          if($edit_url){
            $content .= '<a class="link-edit-blockbuider" href="'. $edit_url .'"> Config block builder </a>';
          }

          $content .= stregtui_blockbuilder_frontend($results->params);
          $content .= '</div>'; 
        }
      }
      $elements[$delta] = array(
        '#type' => 'markup',
        '#id' => $bid,
        '#theme' => 'block-builder',
        '#content' => $content,
        '#cache' => array(
          'max-age' => 0,
        ),
      );
    }
    return $elements;
  }
}