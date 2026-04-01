<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExercisesFixture
 */
class ExercisesFixture extends TestFixture
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
                'id' => '',
                'title' => 'Lorem ipsum dolor sit amet',
                'random' => 1,
                'coef' => 1,
                'timesec' => 1,
                'tries' => 'Lorem ipsum dolor sit amet',
                'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'type' => 1,
                'ansdef' => 1,
                'showans' => 1,
                'grade' => 1,
                'id_chapter' => '',
                'created_at' => 1770890267,
                'updated_at' => 1770890267,
            ],
        ];
        parent::init();
    }
}
