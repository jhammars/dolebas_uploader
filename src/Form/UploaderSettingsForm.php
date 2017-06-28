<?php

namespace Drupal\dolebas_uploader\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WistiaSettingsForm.
 *
 * @package Drupal\dolebas_uploader\Form
 */
class UploaderSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'dolebas_uploader.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dolebas_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dolebas_uploader.settings');
    $form['wistia_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Wistia Token'),
      '#description' => $this->t('Get wistia token from your wistia account.'),
      '#maxlength' => 512,
      '#size' => 64,
      '#default_value' => $config->get('wistia_token'),
    ];
    $form['wistia_project_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Wistia Project Id'),
      '#description' => $this->t('Get wistia Project Id from your wistia account.'),
      '#maxlength' => 512,
      '#size' => 64,
      '#default_value' => $config->get('wistia_project_id'),
    ];
    $form['cloudinary_cloud_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cloudinary Cloud Name'),
      '#description' => $this->t('Enter cloud name from cloudinary account.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('cloudinary_cloud_name'),
    ];
    $form['cloudinary_upload_preset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cloudinary Upload Preset'),
      '#description' => $this->t('Enter Upload preset from cloudinary.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('cloudinary_upload_preset'),
    ];

    return parent::buildForm($form, $form_state);
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
    parent::submitForm($form, $form_state);

    $this->config('dolebas_uploader.settings')
      ->set('wistia_token', $form_state->getValue('wistia_token'))
      ->set('wistia_project_id', $form_state->getValue('wistia_project_id'))
      ->set('cloudinary_cloud_name', $form_state->getValue('cloudinary_cloud_name'))
      ->set('cloudinary_upload_preset', $form_state->getValue('cloudinary_upload_preset'))
      ->save();
  }

}
