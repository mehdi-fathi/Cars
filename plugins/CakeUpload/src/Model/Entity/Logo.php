<?php
namespace CakeUpload\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logo Entity
 *
 * @property int $id
 * @property string $path
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Company[] $companies
 */
class Logo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
