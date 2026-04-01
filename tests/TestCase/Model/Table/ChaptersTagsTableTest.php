<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChaptersTagsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChaptersTagsTable Test Case
 */
class ChaptersTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChaptersTagsTable
     */
    protected $ChaptersTags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ChaptersTags',
        'app.Tags',
        'app.Chapters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ChaptersTags') ? [] : ['className' => ChaptersTagsTable::class];
        $this->ChaptersTags = $this->getTableLocator()->get('ChaptersTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ChaptersTags);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ChaptersTagsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
