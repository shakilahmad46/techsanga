<?php
/**
 * @file
 * Contains \Drupal\insert_view\Plugin\Filter\ShortcodeCorrector.
 */

namespace Drupal\stregtui_blockbuilder\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Filter that corrects html added by wysiwyg editors around shortcodes.
 *
 * @Filter(
 *   id = "shortcode_corrector",
 *   module = "stregtui_blockbuilder",
 *   title = @Translation("Shortcodes - html corrector"),
 *   description = @Translation("Trying to correct the html around shortcodes. Enable only if you using wysiwyg editor."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class ShortcodeCorrector extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    if (!empty($text)) {
      $text = do_shortcode( $text );
    }

    return new FilterProcessResult($text);
  }
 
 public function tips($long = FALSE) {
        $output = '<div>You can use shortcode for block builder module. You can visit admin/structure/stregtui_blockbuilder and get shortcode, sample [gbb name="page_home_1"].<div>';
    return $output;
  }
  
}

