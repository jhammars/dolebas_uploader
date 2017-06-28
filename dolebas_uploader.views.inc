<?php

/**
 * Implements hook_views_data_alter().
 */
function dolebas_uploader_views_data_alter(array &$data) {

  $data['node']['wistia_views_field'] = array(
    'title' => t('Dolebas Wistia Upload Widget'),
    'field' => array(
      'title' => t('Dolebas Wistia Upload Widget'),
      'help' => t('A widget for drag-and-drop uploading of videos to Wistia.'),
      'id' => 'wistia_views_field',
    ),
  );
  $data['node']['cloudinary_views_field'] = array(
    'title' => t('Dolebas Cloudinary Upload Widget'),
    'field' => array(
      'title' => t('Dolebas Cloudinary Upload Widget'),
      'help' => t('A widget for drag-and-drop uploading of imagages to Cloudinary.'),
      'id' => 'cloudinary_views_field',
    ),
  );
}