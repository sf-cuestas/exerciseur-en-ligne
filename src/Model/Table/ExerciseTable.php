<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exercise Model
 *
 * @method \App\Model\Entity\Exercise newEmptyEntity()
 * @method \App\Model\Entity\Exercise newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Exercise> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exercise get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Exercise findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Exercise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Exercise> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exercise|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Exercise saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Exercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exercise>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exercise> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exercise>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exercise> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ExerciseTable extends Table
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

        $this->setTable('exercise');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmptyString('title');

        $validator
            ->boolean('random')
            ->notEmptyString('random');

        $validator
            ->integer('coef')
            ->allowEmptyString('coef');

        $validator
            ->integer('timesec')
            ->allowEmptyString('timesec');

        $validator
            ->scalar('tries')
            ->maxLength('tries', 100)
            ->allowEmptyString('tries');

        $validator
            ->scalar('content')
            ->notEmptyString('content');

        $validator
            ->integer('type')
            ->notEmptyString('type');

        $validator
            ->boolean('ansdef')
            ->notEmptyString('ansdef');

        $validator
            ->boolean('showans')
            ->allowEmptyString('showans');

        $validator
            ->numeric('grade')
            ->allowEmptyString('grade');

        $validator
            ->requirePresence('id_chapter', 'create')
            ->notEmptyString('id_chapter');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
