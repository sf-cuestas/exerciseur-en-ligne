<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersChaptersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersChaptersTable Test Case
 */
class UsersChaptersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersChaptersTable
     */
    protected $UsersChapters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.UsersChapters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersChapters') ? [] : ['className' => UsersChaptersTable::class];
        $this->UsersChapters = $this->getTableLocator()->get('UsersChapters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersChapters);

        parent::tearDown();
    }
}
