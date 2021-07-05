<?php

namespace Drupal\stregtui_webform_element\Plugin\WebformElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\Core\Render\Element\Textfield;
/**
 * Provides a 'webform_auto_text' element.
 *
 * @WebformElement(
 *   id = "stregtui_webform_auto_text",
 *   label = @Translation("Stregtui Auto Text"),
 *   description = @Translation("Provides a form element for auto text get from $_GET['title']."),
 *   category = @Translation("Stregtui Elements"),
 *   multiline = TRUE,
 * )
 */
class StregtuiWebformAutoText extends \Drupal\webform\Plugin\WebformElement\TextField {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    $default_properties = parent::getDefaultProperties();
    return $default_properties;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    return $form;
  }
}
