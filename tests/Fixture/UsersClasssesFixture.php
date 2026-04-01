<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersClasssesFixture
 */
class UsersClasssesFixture extends TestFixture
{
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
                'joined_at' => 1770884355,
            ],
        ];
        parent::init();
    }
}
