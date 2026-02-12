<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exercise Entity
 *
 * @property string $id
 * @property string|null $title
 * @property bool $random
 * @property int|null $coef
 * @property int|null $timesec
 * @property string|null $tries
 * @property string $content
 * @property int $type
 * @property bool $ansdef
 * @property bool|null $showans
 * @property float|null $grade
 * @property string $id_chapter
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $updated_at
 *
 * @property \App\Model\Entity\User[] $users
 */
class Exercise extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'random' => true,
        'coef' => true,
        'timesec' => true,
        'tries' => true,
        'content' => true,
        'type' => true,
        'ansdef' => true,
        'showans' => true,
        'grade' => true,
        'id_chapter' => true,
        'created_at' => true,
        'updated_at' => true,
        'users' => true,
    ];
}
