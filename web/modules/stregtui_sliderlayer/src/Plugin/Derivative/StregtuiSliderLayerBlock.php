<?php

/**
 * @file
 * Contains \Drupal\stregtui_sliderlayer\Derivative\stregtuiSliderLayerBlock.
 */

namespace Drupal\stregtui_sliderlayer\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides blocks which belong to stregtui SliderLayer.
 */
class stregtuiSliderLayerBlock extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if(!\Drupal::database()->schema()->tableExists('stregtui_sliderlayergroups')){
      return "";
    }
    $results = \Drupal::database()->select('{stregtui_sliderlayergroups}', 'd')
          ->fields('d', array('id', 'title'))
          ->execute();
    foreach ($results as $row) {
      $this->derivatives['stregtui_sliderlayer_block____' . $row->id] = $base_plugin_definition;
      $this->derivatives['stregtui_sliderlayer_block____' . $row->id]['admin_label'] = 'stregtui SliderLayer - ' . $row->title;
    }
    return $this->derivatives;
  }
}
