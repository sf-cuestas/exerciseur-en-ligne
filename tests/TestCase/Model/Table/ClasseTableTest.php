<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClasseTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClasseTable Test Case
 */
class ClasseTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClasseTable
     */
    protected $Classe;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Classe',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Classe') ? [] : ['className' => ClasseTable::class];
        $this->Classe = $this->getTableLocator()->get('Classe', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Classe);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ClasseTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
