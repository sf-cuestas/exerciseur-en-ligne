<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagFixture
 */
class TagFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'tag';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '',
                'tag' => 'Lorem ipsum dolor sit amet',
                'weight' => 1,
            ],
        ];
        parent::init();
    }
}
