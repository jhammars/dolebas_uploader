<?php

/**
 * @file
 * Definition of Drupal\dolebas_uploader\Plugin\views\field\WistiaViewsField.
 */

namespace Drupal\dolebas_uploader\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to display upload widget.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("wistia_views_field")
 */
class WistiaViewsField extends FieldPluginBase {

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

    $view_uuid = strip_tags($this->view->field['uuid']->original_value);

    $config = \Drupal::config('dolebas_config.config');
    $token = $config->get('wistia_token');
    $project_id = $config->get('wistia_project_id');

    $element['wistia']  = [
      '#type' => 'inline_template',
      '#theme' => 'wistia_views_field',
      '#div_uuid' => $view_uuid,
      '#attached' => array(
        'library' => array(
          'dolebas_uploader/wistia-views-field'
        ),
        'drupalSettings' => array(
          'uuid' => $view_uuid,
          'token' => $token,
          'project_id' => $project_id,
          'div_uuid' => $view_uuid
        )
      )
    ];
    
    return $element;
  }
}
