<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property string $id
 * @property string|null $id_subject
 * @property string|null $id_user
 * @property string|null $id_exercise
 * @property string|null $id_class
 * @property \Cake\I18n\DateTime $created_at
 * @property int $grade
 */
class Result extends Entity
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
        'id_subject' => true,
        'id_user' => true,
        'id_exercise' => true,
        'id_class' => true,
        'created_at' => true,
        'grade' => true,
    ];
}
