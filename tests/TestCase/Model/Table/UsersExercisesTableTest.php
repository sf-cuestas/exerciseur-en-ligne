<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersExercisesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersExercisesTable Test Case
 */
class UsersExercisesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersExercisesTable
     */
    protected $UsersExercises;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.UsersExercises',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersExercises') ? [] : ['className' => UsersExercisesTable::class];
        $this->UsersExercises = $this->getTableLocator()->get('UsersExercises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersExercises);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\UsersExercisesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
