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
    $build['cloudinary_uploader_block']['#type'] = 'inline_template';
    $build['cloudinary_uploader_block']['#theme'] = 'cloudinary_uploader';
    $build['cloudinary_uploader_block']['#attached'] = array(
      'library' => array(
        'dolebas_uploader/cloudinary-library'
      ),
      'drupalSettings' => array(
        'cloud_name' => 'dolebas',
        'upload_preset' => 'apexn91s',
      )
    );

    return $build;
  }

}
