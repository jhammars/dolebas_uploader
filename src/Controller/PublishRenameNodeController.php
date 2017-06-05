<?php

namespace Drupal\dolebas_uploader\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PublishRenameNodeController.
 *
 * @package Drupal\dolebas_uploader\Controller
 */
class PublishRenameNodeController extends ControllerBase {

  /**
   * Index.
   *
   * @return string
   *   Return Hello string.
   */
  public function index() {
    $ret_array = array('title' => 'Test node');
    return new JsonResponse($ret_array);
  }

}
