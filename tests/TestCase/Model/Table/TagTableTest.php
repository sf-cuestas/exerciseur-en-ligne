<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TagTable Test Case
 */
class TagTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TagTable
     */
    protected $Tag;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Tag',
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
        $config = $this->getTableLocator()->exists('Tag') ? [] : ['className' => TagTable::class];
        $this->Tag = $this->getTableLocator()->get('Tag', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tag);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TagTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
