<?php
function stregtui_fiza_form_contact_message_feedback_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
  
  // Name
  $form['name']['#weight'] = -1;
  $form['name']['#prefix'] = '<div class="contact-feedback"><div class="row"><div class="col-sm-6 col-xs-12"><div class="form-group">';
  $form['name']['#suffix'] = '</div></div>';
  $form['name']['#attributes']['placeholder'][] = $form['name']['#title'].'*';
  $form['name']['#attributes']['class'][] = 'form-control';
  unset($form['name']['#title']);

  // Mail
  $form['mail']['#weight'] = -2;
  $form['mail']['#prefix'] = '<div class="col-sm-6 col-xs-12"><div class="form-group">';
  $form['mail']['#suffix'] = '</div></div></div>';
  $form['mail']['#attributes']['placeholder'][] = $form['mail']['#title'].'*';
  $form['mail']['#attributes']['class'][] = 'form-control';
  unset($form['mail']['#title']);

  // Subject
  $form['subject']['widget'][0]['#weight'] = -3;
  $form['subject']['widget'][0]['#prefix'] = '<div class="form-group">';
  $form['subject']['widget'][0]['#suffix'] = '</div>';
  $form['subject']['widget'][0]['value']['#attributes']['class'][] = 'form-control';
  //$form['subject']['widget'][0]['value']['#attributes']['placeholder'][] = $form['subject']['widget'][0]['#title'].'*';
  unset($form['subject']['widget'][0]['value']['#title']);
 
  // Message
  $form['message']['#weight'] = -5;
  $form['message']['widget'][0]['value']['#attributes']['class'][] = 'form-control';
  //$form['message']['widget'][0]['value']['#attributes']['placeholder'][] = $form['message']['widget'][0]['#title'].'*';
  $form['message']['widget'][0]['#title'] = '';
  unset($form['message']['widget'][0]['value']['#title']);
  $form['message']['widget'][0]['#prefix'] = '<div class="clearfix"><div class="form-group">';
  $form['message']['widget'][0]['#suffix'] = '</div></div>';

  // Submit
  $form['actions']['#weight'] = 99;
  $form['actions']['#prefix'] = '<div class="clearfix">';
  $form['actions']['#suffix'] = '</div></div>';
  $form['actions']['submit']['#attributes']['class'][] = 'btn';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-theme-submit';
  
}

function stregtui_fiza_form_contact_message_book_form_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
  
  // Name
  $form['name']['#weight'] = 1;
  $form['name']['#prefix'] = '<div class="col-sm-6 form-item-icon-name">';
  $form['name']['#suffix'] = '</div>';
  $form['name']['#attributes']['placeholder'][] = $form['name']['#title'].'*';
  $form['name']['#attributes']['class'][] = 'form-control';
  unset($form['name']['#title']);

  // Mail
  $form['mail']['#weight'] = 2;
  $form['mail']['#prefix'] = '<div class="col-sm-6 form-item-icon-email">';
  $form['mail']['#suffix'] = '</div>';
  $form['mail']['#attributes']['placeholder'][] = $form['mail']['#title'].'*';
  $form['mail']['#attributes']['class'][] = 'form-control';
  unset($form['mail']['#title']);

   // Time
  $form['field_book_phone']['#weight'] = 3;
  $form['field_book_phone']['#attributes']['class'][] = 'col-sm-6 form-item-icon-phone';
  $form['field_book_phone']['widget'][0]['value']['#attributes']['placeholder'][] = $form['field_book_phone']['widget'][0]['#title'].'*';
  unset($form['field_book_phone']['widget'][0]['value']['#title']); 

   // Date
  $form['field_book_date']['#weight'] = 4;
  $form['field_book_date']['widget'][0]['#prefix'] = '<div class="col-sm-6 form-item-icon-date"><div class="form-group">';
  $form['field_book_date']['widget'][0]['#suffix'] = '</div></div>';
  $form['field_book_date']['widget'][0]['value']['#attributes']['placeholder'][] = $form['field_book_date']['widget'][0]['#title'].'*';
  $form['field_book_date']['widget'][0]['value']['#attributes']['class'][] = 'form-control';
  unset($form['field_book_date']['widget'][0]['#title']);
  //print "<pre>"; print_r($form['field_book_date']);die();

  // Time
  $form['field_book_time']['#weight'] = 5;
  $form['field_book_time']['#attributes']['class'][] = 'col-sm-6 form-group form-item-icon-time';
  $form['field_book_time']['widget'][0]['value']['#attributes']['placeholder'][] = $form['field_book_guests']['widget'][0]['#title'].'*';
  unset($form['field_book_time']['widget']['#title']);
  //print "<pre>"; print_r($form['field_book_time']);die();
  
  // size
  $form['field_book_guests']['#weight'] = 6;
  $form['field_book_guests']['#attributes']['class'][] = 'col-sm-6 form-group form-item-icon-guests';
  $form['field_book_guests']['widget'][0]['value']['#attributes']['class'][] = 'form-control';
  $form['field_book_guests']['widget'][0]['value']['#attributes']['placeholder'][] = $form['field_book_guests']['widget'][0]['#title'].'*';
  unset($form['field_book_guests']['widget'][0]['value']['#title']);
//print "<pre>"; print_r($form['field_book_size']);die();

  // Message
  $form['message']['#weight'] = 7;
  $form['message']['widget'][0]['value']['#attributes']['class'][] = 'form-control';
  unset($form['message']['widget'][0]['value']['#title']);
  $form['message']['widget'][0]['#prefix'] = '<div class="clearfix col-sm-12 form-item-icon-message">';
  $form['message']['widget'][0]['#suffix'] = '</div>';
  $form['message']['#required'] = FALSE;

  $form['copy']['#weight'] = 98;

  // Submit
  $form['actions']['#weight'] = 99;
  $form['actions']['#prefix'] = '<div class="clearfix form-action">';
  $form['actions']['#suffix'] = '</div>';
  $form['actions']['submit']['#attributes']['class'][] = 'btn';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-theme-submit';
  
  $form['subject']['#access'] = FALSE;
  $form['subject']['#required'] = FALSE;
}