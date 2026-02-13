<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersChaptersFixture
 */
class UsersChaptersFixture extends TestFixture
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
                'id_chapter' => '',
            ],
        ];
        parent::init();
    }
}
