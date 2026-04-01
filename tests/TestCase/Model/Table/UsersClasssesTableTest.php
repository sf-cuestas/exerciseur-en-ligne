<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersClasssesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersClasssesTable Test Case
 */
class UsersClasssesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersClasssesTable
     */
    protected $UsersClassses;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.UsersClassses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersClassses') ? [] : ['className' => UsersClasssesTable::class];
        $this->UsersClassses = $this->getTableLocator()->get('UsersClassses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersClassses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\UsersClasssesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
