<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CreationcodesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CreationcodesTable Test Case
 */
class CreationcodesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CreationcodesTable
     */
    protected $Creationcodes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Creationcodes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Creationcodes') ? [] : ['className' => CreationcodesTable::class];
        $this->Creationcodes = $this->getTableLocator()->get('Creationcodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Creationcodes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CreationcodesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
