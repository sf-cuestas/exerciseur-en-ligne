<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChaptersTagsFixture
 */
class ChaptersTagsFixture extends TestFixture
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
                'tag_id' => '',
                'chapter_id' => '',
            ],
        ];
        parent::init();
    }
}
