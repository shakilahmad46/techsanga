<?php
namespace Drupal\stregtui_blockbuilder\Form;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation;
use Drupal\Core\Url;
class AddForm implements FormInterface {
   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'add_form';
   }

   /**
    * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
   public function buildForm(array $form, FormStateInterface $form_state) {
      $bid = 0;
      if(\Drupal::request()->attributes->get('bid')) $bid = \Drupal::request()->attributes->get('bid');
      if (is_numeric($bid) && $bid > 0) {
        $bblock = \Drupal::database()->select('{stregtui_blockbuilder}', 'd')
          ->fields('d', array('id', 'title', 'body_class'))
          ->condition('id', $bid)
          ->execute()
          ->fetchAssoc();
      } else {
        $bblock = array('id' => 0, 'title' => '', 'body_class'=>'');
      }      

      $form['id'] = array(
        '#type' => 'hidden',
        '#default_value' => $bblock['id']
      );
      $form['title'] = array(
        '#type' => 'textfield',
        '#title' => 'Title',
        '#default_value' => $bblock['title']
      );
       $form['body_class'] = array(
        '#type' => 'textfield',
        '#title' => 'Machine name',
        '#description' => 'A unique machine-readable name containing letters, numbers, and underscores<br>Sample home_page_1, Use shortcode for page basic [gbb name="home_page_1"]',
        '#default_value' => $bblock['body_class']
      );
       if(trim($bblock['body_class'])){
        $form['body_class']['#attributes'] = array('readonly' => 'true');
       }
      $form['actions'] = array('#type' => 'actions');
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Save'
      );
    return $form;
   }

   /**
   * Implements \Drupal\Core\Form\FormInterface::validateForm().
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!$form_state->getValue('title')  ) {
      $form_state->setErrorByName('title', 'Please enter title for buider block.');
    }
    if (!$form_state->getValue('body_class') ) {
      $form_state->setErrorByName('title', ('Please enter Machine name for buider block.'));
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $form_state->getValue('body_class'))){
      $form_state->setErrorByName('title', ('The machine-readable name must contain only lowercase letters, numbers, and underscores.'));
    }
    if(stregtui_blockbuilder_check_machine($form_state->getValue('id'), $form_state->getValue('body_class'))){
      $form_state->setErrorByName('title', ('Machine name for buider block exits.'));
    }
  }

   /**
   * Implements \Drupal\Core\Form\FormInterface::submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      if (is_numeric($form['id']['#value']) && $form['id']['#value'] > 0) {
        
          $pid = \Drupal::database()->update("stregtui_blockbuilder")
            ->fields(array(
                'title'       => $form['title']['#value'],
                'body_class'  => $form['body_class']['#value']
            ))
            ->condition('id', $form['id']['#value'])
            ->execute();  

          \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
        \Drupal::messenger()->addMessage("blockbuilder '{$form['title']['#value']}' has been update");
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse(Url::fromRoute('stregtui_blockbuilder.admin')->toString());
        $response->send();
      } else {
        $pid = \Drupal::database()->insert("stregtui_blockbuilder")
          ->fields(array(
              'title'       => $form['title']['#value'],
              'body_class'  => $form['body_class']['#value'],
              'params'      => '',
          ))
          ->execute();
          \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
        \Drupal::messenger()->addMessage("blockbuilder '{$form['title']['#value']}' has been created");
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse(Url::fromRoute('stregtui_blockbuilder.admin')->toString());
        $response->send();
      } 
   }
}