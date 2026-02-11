<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChapterTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChapterTable Test Case
 */
class ChapterTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChapterTable
     */
    protected $Chapter;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Chapter',
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
        $config = $this->getTableLocator()->exists('Chapter') ? [] : ['className' => ChapterTable::class];
        $this->Chapter = $this->getTableLocator()->get('Chapter', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Chapter);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ChapterTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
