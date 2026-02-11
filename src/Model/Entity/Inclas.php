<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inclas Entity
 *
 * @property string $id_user
 * @property string $id_class
 * @property bool $responsible
 * @property \Cake\I18n\DateTime $joined_at
 */
class Inclas extends Entity
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
        'responsible' => true,
        'joined_at' => true,
    ];
}
