<?php

/**
 * @file
 * Contains \Drupal\stregtui_sliderlayer\Plugin\Block\stregtuiSliderLayerBlock.
 */

namespace Drupal\stregtui_sliderlayer\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides blocks which belong to stregtui Slider.
 *
 *
 * @Block(
 *   id = "stregtui_sliderlayer_block",
 *   admin_label = @Translation("stregtui SliderLayer"),
 *   category = @Translation("stregtui Slider"),
 *   deriver = "Drupal\stregtui_sliderlayer\Plugin\Derivative\stregtuiSliderLayerBlock",
 * )
 *
 */

class stregtuiSliderLayerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $sid = $this->getDerivativeId();

     $block = array();
      if (str_replace('stregtui_sliderlayer_block____', '', $sid) != $sid) {
        $sid = str_replace('stregtui_sliderlayer_block____', '', $sid);

        $content_block = stregtui_sliderlayer_block_content($sid);

        if(!$content_block) $content_block =  'No block builder selected';
        $block = array(
          '#theme' => 'block-slider',
          '#content' => $content_block,
          '#cache' => array('max-age' => 0)
        );
      }

      return $block;
  }


  /**
   *  Default cache is disabled.
   *
   * @param array $form
   * @param \Drupal\stregtui_sliderlayer\Plugin\Block\FormStateInterface $form_state
   * @return
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $rebuild_form = parent::buildConfigurationForm($form, $form_state);
    return $rebuild_form;
  }

}
