<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InclassTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InclassTable Test Case
 */
class InclassTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InclassTable
     */
    protected $Inclass;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Inclass',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Inclass') ? [] : ['className' => InclassTable::class];
        $this->Inclass = $this->getTableLocator()->get('Inclass', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Inclass);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\InclassTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
