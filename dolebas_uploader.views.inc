<?php

/**
 * Implements hook_views_data_alter().
 */
function dolebas_uploader_views_data_alter(array &$data) {

  $data['node']['dolebas_uploader_wistia_field'] = array(
    'title' => t('Dolebas Wistia Upload Field'),
    'field' => array(
      'title' => t('Dolebas Wistia Upload Field'),
      'help' => t('A widget for drag-and-drop uploading of videos to Wistia.'),
      'id' => 'dolebas_uploader_wistia_field',
    ),
  );
}