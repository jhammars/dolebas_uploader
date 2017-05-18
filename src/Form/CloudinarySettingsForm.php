<?php

namespace Drupal\dolebas_uploader\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CloudinarySettingsForm.
 *
 * @package Drupal\dolebas_uploader\Form
 */
class CloudinarySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'dolebas_uploader.cloudinarysettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cloudinary_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dolebas_uploader.cloudinarysettings');
    $form['cloud_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cloud Name'),
      '#description' => $this->t('Enter cloud name from cloudinary account.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('cloud_name'),
    ];
    $form['upload_preset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Upload Preset'),
      '#description' => $this->t('Enter Upload preset from cloudinary.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('upload_preset'),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
    $this->config('dolebas_uploader.cloudinarysettings')
      ->set('cloud_name', $form_state->getValue('cloud_name'))
      ->set('upload_preset', $form_state->getValue('upload_preset'))
      ->save();
  }

}
