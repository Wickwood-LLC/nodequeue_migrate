<?php
// @codingStandardsIgnoreFile
/**
 * @file
 * A database agnostic dump for testing purposes.
 *
 * This file was generated by the Drupal 8.0 db-tools.php script.
 */

use Drupal\Core\Database\Database;

$connection = Database::getConnection();

$connection->schema()->createTable('nodequeue_nodes', array(
  'fields' => array(
    'qid' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'sqid' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'nid' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'position' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'timestamp' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'default' => '0',
      'unsigned' => TRUE,
    ),
  ),
  'indexes' => array(
    'sqid' => array(
      'sqid',
      'position',
    ),
    'qid_nid' => array(
      'qid',
      'nid',
    ),
    'nid' => array(
      'nid',
    ),
  ),
  'mysql_character_set' => 'utf8',
));

$connection->insert('nodequeue_nodes')
->fields(array(
  'qid',
  'sqid',
  'nid',
  'position',
  'timestamp',
))
->values(array(
  'qid' => '1',
  'sqid' => '1',
  'nid' => '5',
  'position' => '1',
  'timestamp' => '1296580447',
))
->values(array(
  'qid' => '1',
  'sqid' => '1',
  'nid' => '6',
  'position' => '2',
  'timestamp' => '1296580447',
))
->values(array(
  'qid' => '2',
  'sqid' => '2',
  'nid' => '1',
  'position' => '1',
  'timestamp' => '1296591524',
))
->values(array(
  'qid' => '2',
  'sqid' => '3',
  'nid' => '2',
  'position' => '1',
  'timestamp' => '1296592798',
))
->values(array(
  'qid' => '2',
  'sqid' => '3',
  'nid' => '3',
  'position' => '2',
  'timestamp' => '1296592798',
))
->execute();

$connection->schema()->createTable('nodequeue_queue', array(
  'fields' => array(
    'qid' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'title' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '255',
    ),
    'subqueue_title' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '255',
    ),
    'size' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'default' => '0',
    ),
    'link' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '40',
    ),
    'link_remove' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '40',
    ),
    'owner' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
    ),
    'show_in_ui' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
      'default' => '1',
    ),
    'show_in_tab' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
      'default' => '1',
    ),
    'show_in_links' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
      'default' => '1',
    ),
    'reference' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
      'default' => '0',
    ),
    'reverse' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
    ),
    'i18n' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'tiny',
      'default' => '1',
    ),
    'name' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '128',
    ),
  ),
  'primary key' => array(
    'qid',
  ),
  'unique keys' => array(
    'name' => array(
      'name',
    ),
  ),
  'mysql_character_set' => 'utf8',
));

$connection->insert('nodequeue_queue')
->fields(array(
  'qid',
  'title',
  'subqueue_title',
  'size',
  'link',
  'link_remove',
  'owner',
  'show_in_ui',
  'show_in_tab',
  'show_in_links',
  'reference',
  'reverse',
  'i18n',
  'name',
))
->values(array(
  'qid' => '1',
  'title' => 'Queue example 1',
  'subqueue_title' => '',
  'size' => '0',
  'link' => '',
  'link_remove' => '',
  'owner' => 'nodequeue',
  'show_in_ui' => '1',
  'show_in_tab' => '1',
  'show_in_links' => '1',
  'reference' => '0',
  'reverse' => '0',
  'i18n' => '1',
  'name' => 'queue_example_1',
))
->values(array(
  'qid' => '2',
  'title' => 'Queue parent example',
  'subqueue_title' => '',
  'size' => '99',
  'link' => '',
  'link_remove' => '',
  'owner' => 'nodequeue',
  'show_in_ui' => '1',
  'show_in_tab' => '1',
  'show_in_links' => '1',
  'reference' => '0',
  'reverse' => '0',
  'i18n' => '1',
  'name' => 'queue_parent_example',
))
->execute();

$connection->schema()->createTable('nodequeue_subqueue', array(
  'fields' => array(
    'sqid' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'qid' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'reference' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
      'default' => '0',
    ),
    'title' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
      'default' => '',
    ),
  ),
  'primary key' => array(
    'sqid',
  ),
  'indexes' => array(
    'qid' => array(
      'qid',
    ),
    'reference' => array(
      'reference',
    ),
    'title' => array(
      'title',
    ),
  ),
  'mysql_character_set' => 'utf8',
));

$connection->insert('nodequeue_subqueue')
->fields(array(
  'sqid',
  'qid',
  'reference',
  'title',
))
->values(array(
  'sqid' => '1',
  'qid' => '1',
  'reference' => '1',
  'title' => 'Subqueue example 1',
))
->values(array(
  'sqid' => '2',
  'qid' => '2',
  'reference' => '2',
  'title' => 'Subqueue example 2',
))
->values(array(
  'sqid' => '3',
  'qid' => '2',
  'reference' => '3',
  'title' => 'Subqueue example 3',
))
->execute();

$connection->schema()->createTable('nodequeue_types', array(
  'fields' => array(
    'qid' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'big',
      'unsigned' => TRUE,
    ),
    'type' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
    ),
  ),
  'indexes' => array(
    'qid' => array(
      'qid',
    ),
    'type' => array(
      'type',
    ),
  ),
  'mysql_character_set' => 'utf8',
));

$connection->insert('nodequeue_types')
->fields(array(
  'qid',
  'type',
))
->values(array(
  'qid' => '1',
  'type' => 'page',
))
->values(array(
  'qid' => '1',
  'type' => 'blog',
))
->values(array(
  'qid' => '2',
  'type' => 'page',
))
->execute();
