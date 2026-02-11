<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Result Model
 *
 * @method \App\Model\Entity\Result newEmptyEntity()
 * @method \App\Model\Entity\Result newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Result> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Result get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Result findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Result patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Result> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Result|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Result saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ResultTable extends Table
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

        $this->setTable('results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id_subject');

        $validator
            ->allowEmptyString('id_user');

        $validator
            ->allowEmptyString('id_exercise');

        $validator
            ->allowEmptyString('id_class');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->integer('grade')
            ->notEmptyString('grade');

        return $validator;
    }
}
