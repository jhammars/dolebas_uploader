<?php

namespace Drupal\dolebas_uploader\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CloudinaryUploaderBlock' block.
 *
 * @Block(
 *  id = "cloudinary_uploader_block",
 *  admin_label = @Translation("Cloudinary uploader block"),
 * )
 */
class CloudinaryUploaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
//    $config = \Drupal::config('dolebas_uploader.cloudinarysettings');
    $config = \Drupal::config('dolebas_uploader.settings');
    $cloud_name = $config->get('cloudinary_cloud_name');
    $upload_preset = $config->get('cloudinary_upload_preset');

    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node) {
      $nid = $node->id();
    }

    $build['cloudinary_uploader_block']['#type'] = 'inline_template';
    $build['cloudinary_uploader_block']['#theme'] = 'cloudinary_uploader';
    $build['cloudinary_uploader_block']['#attached'] = array(
      'library' => array(
        'dolebas_uploader/cloudinary-library'
      ),
      'drupalSettings' => array(
        'cloud_name' => $cloud_name,
        'upload_preset' => $upload_preset,
        'nid' => $nid,
      )
    );

    return $build;
  }

}
