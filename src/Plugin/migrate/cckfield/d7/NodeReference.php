<?php

namespace Drupal\nodequeue_migrate\Plugin\migrate\cckfield\d7;

use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate_drupal\Plugin\migrate\cckfield\CckFieldPluginBase;

/**
 * @MigrateCckField(
 *   id = "node_reference"
 * )
 */
class NodeReference extends CckFieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFieldFormatterMap() {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function processCckFieldValues(MigrationInterface $migration, $field_name, $data) {
    $process = array(
      'plugin' => 'iterator',
      'source' => $field_name,
      'process' => array(
        'target_id' => 'nid',
      ),
    );
    $migration->setProcessOfProperty($field_name, $process);
  }

}
