<?php

namespace Drupal\dolebas_uploader\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;

/**
 * Provides a 'DolebasUploaderBlock' block.
 *
 * @Block(
 *  id = "dolebas_uploader_block",
 *  admin_label = @Translation("Dolebas uploader block"),
 * )
 */
class DolebasUploaderBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManager definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        EntityTypeManager $entity_type_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('dolebas_uploader.settings');
    $token = $config->get('wistia_token');
    $project_id = $config->get('wistia_project_id');

    //'https:/we/api.wistia.com/v1/medias.json?api_password=' . $token;
    // $client = \Drupal::httpClient();
    // $url = 'https://api.wistia.com/v1/medias.json?api_password=' . $token;
    // $response = $client->request('GET', $url);
    // $request = $client->get($url);
    // $response = $request->getBody();
    // $response = $client->send($request);
    //print '<pre>';print_r($project_id);exit;
    // print '<pre>';print_r($url);exit;

    /**
     * @var $node \Drupal\node\NodeInterface
     */
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node) {
      $nid = $node->id();
      $uuid = $node->uuid();
    }
    $build = [];
    $build['dolebas_uploader_block']['#type'] = 'inline_template';
    $build['dolebas_uploader_block']['#theme'] = 'dolebas_uploader';
    $build['dolebas_uploader_block']['#attached'] = array(
      'library' => array(
        'dolebas_uploader/dolebas-library'
      ),
      'drupalSettings' => array(
        'nid' => $nid,
        'token' => $token,
        'uuid' => $uuid,
        'project_id' => $project_id
      )
    );
    $build['#cache']['max-age'] = 0;

    return $build;
  }

}
