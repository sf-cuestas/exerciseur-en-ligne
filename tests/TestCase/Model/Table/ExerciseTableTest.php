<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExerciseTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExerciseTable Test Case
 */
class ExerciseTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExerciseTable
     */
    protected $Exercise;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Exercise',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exercise') ? [] : ['className' => ExerciseTable::class];
        $this->Exercise = $this->getTableLocator()->get('Exercise', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exercise);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ExerciseTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
