<?php

/**
 * @file
 * Contains \Drupal\stregtui_blockbuilder\Derivative\GGBBlock.
 */

namespace Drupal\stregtui_blockbuilder\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides blocks which belong to stregtuiBlockbuilder.
 */
class GGBBlock extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $results = \Drupal::database()->select('{stregtui_blockbuilder}', 'd')
          ->fields('d', array('id', 'title'))
          ->execute();
    foreach ($results as $row) {
      $this->derivatives['stregtui_blockbuilder_block____' . $row->id] = $base_plugin_definition;
      $this->derivatives['stregtui_blockbuilder_block____' . $row->id]['admin_label'] = 'stregtuiBlockbuider ' . $row->title;
    }
    return $this->derivatives;
  }
}
