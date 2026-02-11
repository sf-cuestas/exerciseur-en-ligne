<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResultTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResultTable Test Case
 */
class ResultTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResultTable
     */
    protected $Result;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Result',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Result') ? [] : ['className' => ResultTable::class];
        $this->Result = $this->getTableLocator()->get('Result', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Result);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ResultTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
