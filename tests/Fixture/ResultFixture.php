<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultFixture
 */
class ResultFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'result';
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
                'id_subject' => '',
                'id_user' => '',
                'id_exercise' => '',
                'id_class' => '',
                'created_at' => 1770827390,
                'grade' => 1,
            ],
        ];
        parent::init();
    }
}
