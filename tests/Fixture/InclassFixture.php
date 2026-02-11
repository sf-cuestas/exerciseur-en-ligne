<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InclassFixture
 */
class InclassFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'inclass';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_user' => '',
                'id_class' => '',
                'responsible' => 1,
                'joined_at' => 1770824466,
            ],
        ];
        parent::init();
    }
}
