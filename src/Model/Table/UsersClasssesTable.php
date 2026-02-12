<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersClassses Model
 *
 * @method \App\Model\Entity\UsersClasss newEmptyEntity()
 * @method \App\Model\Entity\UsersClasss newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersClasss> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersClasss get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UsersClasss findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UsersClasss patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersClasss> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersClasss|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UsersClasss saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UsersClasss>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersClasss>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersClasss>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersClasss> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersClasss>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersClasss>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersClasss>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersClasss> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UsersClasssesTable extends Table
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

        $this->setTable('users_classses');
        $this->setDisplayField(['id_user', 'id_class']);
        $this->setPrimaryKey(['id_user', 'id_class']);
        $this->belongsTo('Users');
        $this->belongsTo('Classses');
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
