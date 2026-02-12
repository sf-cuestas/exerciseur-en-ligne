<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClasssesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClasssesTable Test Case
 */
class ClasssesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClasssesTable
     */
    protected $Classses;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Classses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Classses') ? [] : ['className' => ClasssesTable::class];
        $this->Classses = $this->getTableLocator()->get('Classses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Classses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ClasssesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
