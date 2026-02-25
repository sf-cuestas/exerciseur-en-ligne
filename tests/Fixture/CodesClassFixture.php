<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CodesClassFixture
 */
class CodesClassFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'codes_class';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'code' => 'Lorem ip',
                'num_usages' => 1,
                'id_class' => '',
            ],
        ];
        parent::init();
    }
}
