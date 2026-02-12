<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classses Model
 *
 * @method \App\Model\Entity\Classs newEmptyEntity()
 * @method \App\Model\Entity\Classs newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Classs> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Classs get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Classs findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Classs patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Classs> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Classs|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Classs saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Classs>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classs>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classs>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classs> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classs>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classs>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classs>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classs> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ClasssesTable extends Table
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

        $this->setTable('classses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->hasMany('UsersClasss');
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
