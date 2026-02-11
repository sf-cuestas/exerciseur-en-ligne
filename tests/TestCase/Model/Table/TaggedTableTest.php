<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaggedTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaggedTable Test Case
 */
class TaggedTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaggedTable
     */
    protected $Tagged;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Tagged',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tagged') ? [] : ['className' => TaggedTable::class];
        $this->Tagged = $this->getTableLocator()->get('Tagged', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tagged);

        parent::tearDown();
    }
}
