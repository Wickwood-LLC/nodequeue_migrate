<?php

namespace Drupal\Tests\nodequeue_migrate\Kernel\Migrate\d7;

use Drupal\entityqueue\Entity\EntityQueue;
use Drupal\entityqueue\Entity\EntitySubqueue;
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;

/**
 * Tests nodequeue migration.
 *
 * @group nodequeue
 */
class MigrateNodeQueueTest extends MigrateDrupal7TestBase {

  static $modules = [
    'node',
    'nodequeue_migrate',
    'entityqueue',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->loadFixture(__DIR__ . '/../../../../fixtures/drupal7.php');
    $this->installEntitySchema('entity_subqueue');
    $this->executeMigrations([
      'd7_nodequeue',
      'd7_nodesubqueue',
    ]);
  }

  protected function assertQueueEntity($id, $label, $target_bundles, $handler = 'simple', $max_size = 0) {
    /** @var EntityQueue $queue */
    $queue = EntityQueue::load($id);
    $this->assertInstanceOf(EntityQueue::class, $queue);
    $this->assertSame($label, $queue->label());
    $this->assertSame($target_bundles, $queue->getEntitySettings()['handler_settings']['target_bundles']);
    $this->assertSame($handler, $queue->getHandler());
    $this->assertSame($max_size, $queue->getMaximumSize());
  }

  protected function assertSubqueueEntity($id, $queue_id, $title, $items) {
    /** @var EntitySubqueue $subqueue */
    $subqueue = EntitySubqueue::load($id);
    $this->assertInstanceOf(EntitySubqueue::class, $subqueue);
    $this->assertSame($queue_id, $subqueue->getQueue()->id());
    $this->assertSame($title, $subqueue->getTitle());
    foreach ($subqueue->get('items')->getValue() as $key => $item) {
      $this->assertSame((string) $items[$key], $item['target_id']);
    }
  }

  /**
   * Test nodequeue migration from Drupal 7 to 8.
   */
  public function testNodequeue() {
    $this->assertQueueEntity('queue_example_1', 'Queue example 1', ['page', 'blog']);
    $this->assertQueueEntity('queue_parent_example', 'Queue parent example', ['page'], 'multiple', 99);

    $this->assertSubqueueEntity('queue_example_1', 'queue_example_1', 'Subqueue example 1', [5, 6]);
    $this->assertSubqueueEntity('2', 'queue_parent_example', 'Subqueue example 2', [1]);
    $this->assertSubqueueEntity('3', 'queue_parent_example', 'Subqueue example 3', [2, 3]);
  }
}
