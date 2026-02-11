<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Owns Model
 *
 * @method \App\Model\Entity\Own newEmptyEntity()
 * @method \App\Model\Entity\Own newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Own> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Own get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Own findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Own patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Own> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Own|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Own saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Own>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Own>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Own>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Own> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Own>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Own>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Own>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Own> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OwnsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('owns');
        $this->setDisplayField(['id_user', 'id_chapter']);
        $this->setPrimaryKey(['id_user', 'id_chapter']);
    }
}
