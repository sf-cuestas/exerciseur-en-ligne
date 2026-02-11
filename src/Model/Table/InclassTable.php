<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inclass Model
 *
 * @method \App\Model\Entity\Inclas newEmptyEntity()
 * @method \App\Model\Entity\Inclas newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Inclas> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inclas get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Inclas findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Inclas patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Inclas> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inclas|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Inclas saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Inclas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inclas>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inclas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inclas> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inclas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inclas>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inclas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inclas> deleteManyOrFail(iterable $entities, array $options = [])
 */
class InclassTable extends Table
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

        $this->setTable('inclass');
        $this->setDisplayField(['id_user', 'id_class']);
        $this->setPrimaryKey(['id_user', 'id_class']);
        $this->belongsToMany('Users');
        $this->belongsToMany('Classes');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->boolean('responsible')
            ->notEmptyString('responsible');

        $validator
            ->dateTime('joined_at')
            ->notEmptyDateTime('joined_at');

        return $validator;
    }
}
