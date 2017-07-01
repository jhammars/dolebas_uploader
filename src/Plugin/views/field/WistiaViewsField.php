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

    $viewnid = strip_tags($this->view->field['nid']->original_value);
    if ($viewnid) {
      $nid = $viewnid;
    }
    else {
      $nid = NULL;
    }

    $config = \Drupal::config('dolebas_config.config');
    $token = $config->get('wistia_token');
    $project_id = $config->get('wistia_project_id');

    $element['wistia']  = [
      '#type' => 'inline_template',
      '#theme' => 'wistia_views_field',
      '#attached' => array(
        'library' => array(
          'dolebas_uploader/wistia-views-field'
        ),
        'drupalSettings' => array(
          'nid' => $nid,
          'token' => $token,
          'project_id' => $project_id
        )
      )
    ];
    
    return $element;
  }
}
