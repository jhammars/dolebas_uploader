<?php

/**
 * @file
 * Definition of Drupal\dolebas_uploader\Plugin\views\field\CloudinaryViewsField.
 */

namespace Drupal\dolebas_uploader\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to display upload widget.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("cloudinary_views_field")
 */
class CloudinaryViewsField extends FieldPluginBase {

  /**
   * @{inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }

  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {

    $uuid = strip_tags($this->view->field['uuid']->original_value);

    $config = \Drupal::config('dolebas_config.config');
    $cloud_name = $config->get('cloudinary_cloud_name');
    $upload_preset = $config->get('cloudinary_upload_preset');

    $element['cloudinary_views_field']  = [
      '#type' => 'inline_template',
      '#theme' => 'cloudinary_views_field',
      '#div_uuid' => $uuid,
      '#attached' => array(
        'library' => array(
          'dolebas_uploader/cloudinary-views-field'
         ),
         'drupalSettings' => array(
           'cloud_name' => $cloud_name,
           'upload_preset' => $upload_preset,
           'uuid' => $uuid,
           'div_uuid' => $uuid
        )        
      )
    ];
    //$element['#cache']['max-age'] = 0;

    return $element;

  }
}
