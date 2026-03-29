<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersExercises Model
 *
 * @method \App\Model\Entity\UsersExercise newEmptyEntity()
 * @method \App\Model\Entity\UsersExercise newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersExercise> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersExercise get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UsersExercise findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UsersExercise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersExercise> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersExercise|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UsersExercise saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UsersExercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersExercise>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersExercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersExercise> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersExercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersExercise>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersExercise>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersExercise> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UsersExercisesTable extends Table
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

        $this->setTable('users_exercises');
        $this->belongsToMany('Exercises');
        $this->belongsToMany('Users');
        $this->setDisplayField(['id_user', 'id_exercise']);
        $this->setPrimaryKey(['id_user', 'id_exercise']);
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
            ->integer('id_user');

        $validator
            ->integer('id_exercise');

        $validator
            ->scalar('answer')
            ->requirePresence('answer', 'create')
            ->notEmptyString('answer');

        $validator
            ->numeric('grade')
            ->allowEmptyString('grade');

        return $validator;
    }
}
