<?php

/**
 * @file
 * Contains \Drupal\stregtui_blockbuilder\Plugin\Block\GGBBlock.
 */

namespace Drupal\stregtui_blockbuilder\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
/**
 * Provides blocks which belong to stregtuiBlockbuilder.
 *
 *
 * @Block(
 *   id = "stregtui_blockbuilder_block",
 *   admin_label = @Translation("stregtuiBlockbuilder"),
 *   category = @Translation("stregtuiBlockbuilder"),
 *   deriver = "Drupal\stregtui_blockbuilder\Plugin\Derivative\GGBBlock",
 * )
 *
 */

class GGBBlock extends BlockBase {

  protected $bid;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $bid = $this->getDerivativeId();
    $this->bid = $bid;
     $block = array();
      if (str_replace('stregtui_blockbuilder_block____', '', $bid) != $bid) {
        $bid = str_replace('stregtui_blockbuilder_block____', '', $bid);
        $results = stregtui_blockbuilder_load($bid);
        if(!$results) return 'No block builder selected';
        $content_block = stregtui_blockbuilder_frontend($results->params);
        $user = \Drupal::currentUser();
        $url = \Drupal::request()->getRequestUri();
        $edit_url = '';
        if($user->hasPermission('administer stregtuiblockbuilder')){
          $edit_url = Url::fromRoute('stregtui_blockbuilder.admin.edit', array('bid' => $bid, 'destination' =>  $url))->toString();
        }
        //print $content_block;
        $block = array(
          '#theme' => 'block-builder',
          '#content' => $content_block,
          '#edit_url' => $edit_url,
          '#cache' => array('max-age' => 0)
        );
      }

      return $block;
  }
  /**
   *  Default cache is disabled.
   *
   * @param array $form
   * @param \Drupal\stregtui_blockbuilder\Plugin\Block\FormStateInterface $form_state
   * @return
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $rebuild_form = parent::buildConfigurationForm($form, $form_state);
    $rebuild_form['cache']['max_age']['#default_value'] = 0;
    return $rebuild_form;
  }
}
