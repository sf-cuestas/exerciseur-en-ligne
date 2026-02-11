<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OwnsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OwnsTable Test Case
 */
class OwnsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OwnsTable
     */
    protected $Owns;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Owns',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Owns') ? [] : ['className' => OwnsTable::class];
        $this->Owns = $this->getTableLocator()->get('Owns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Owns);

        parent::tearDown();
    }
}
