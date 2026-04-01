<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chapter Entity
 *
 * @property string $id
 * @property bool $visible
 * @property int $level
 * @property string $title
 * @property string|null $description
 * @property int|null $secondstimelimit
 * @property int|null $corrend
 * @property int|null $tries
 * @property string|null $class
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $updated_at
 * @property int|null $weight
 *
 * @property \App\Model\Entity\Tagged[] $tagged
 */
class Chapter extends Entity
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
        'visible' => true,
        'level' => true,
        'title' => true,
        'description' => true,
        'secondstimelimit' => true,
        'corrend' => true,
        'tries' => true,
        'class' => true,
        'created_at' => true,
        'updated_at' => true,
        'weight' => true,
        'tagged' => true,
    ];
}
