<?php

namespace Drupal\wistia_video_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'wistia_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "wistia_field_widget",
 *   label = @Translation("Wistia field widget"),
 *   field_types = {
 *     "wistia_video_field"
 *   }
 * )
 */
class WistiaFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'size' => 60,
      'placeholder' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['video_id'] = $element + [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->video_id) ? $items[$delta]->video_id : NULL,
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#attributes' => array('class' => array('wistia-video-id', 'element-invisible')),
      '#attached' => array(
        'library' => array(
          'wistia_video_field/wistia-library'
        ),
        'drupalSettings' => array(
          'token' => $token
        )
      )
    ];
    $config = \Drupal::config('wistia_video_field.wistiasettings');
    $token = $config->get('wistia_token');
    $element['upload_widget']  = [
      '#type' => 'inline_template',
      '#theme' => 'wistia_video_field',
      '#attached' => array(
        'library' => array(
          'wistia_video_field/wistia-library'
        ),
        'drupalSettings' => array(
          'token' => $token
        )
      )
    ];

    return $element;
  }

}
