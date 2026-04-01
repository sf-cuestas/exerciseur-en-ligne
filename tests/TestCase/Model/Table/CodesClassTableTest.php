<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CodesClassTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CodesClassTable Test Case
 */
class CodesClassTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CodesClassTable
     */
    protected $CodesClass;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CodesClass',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CodesClass') ? [] : ['className' => CodesClassTable::class];
        $this->CodesClass = $this->getTableLocator()->get('CodesClass', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CodesClass);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CodesClassTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
