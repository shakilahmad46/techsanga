<?php

namespace Drupal\stregtui_webform_element\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;

/**
 * @FormElement("stregtui_webform_auto_text")
 *
 */
class StregtuiWebformAutoText extends Textfield {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    $info = parent::getInfo();
    $info['#pre_render'][] = [$class, 'preRenderStregtuiWebformAutoText'];
    $info['#process'][] = [$class, 'processValueStregtuiWebfromAutoText'];
    return $info;
  }

  public static function preRenderStregtuiWebformAutoText($element) {
    static::setAttributes($element, ['stregtui-webform-auto-text-element']);
    return $element;
  }

  public static function processValueStregtuiWebfromAutoText(&$element, FormStateInterface $form_state, &$complete_form) {
    $title = \Drupal::request()->query->get('title');
    if ($title && !empty($title)) {
      $element['#value'] = $title;
    }
    return $element;
  }
}
