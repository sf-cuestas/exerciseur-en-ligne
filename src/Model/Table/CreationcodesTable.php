<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Creationcodes Model
 *
 * @method \App\Model\Entity\Creationcode newEmptyEntity()
 * @method \App\Model\Entity\Creationcode newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Creationcode> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Creationcode get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Creationcode findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Creationcode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Creationcode> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Creationcode|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Creationcode saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Creationcode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Creationcode>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Creationcode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Creationcode> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Creationcode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Creationcode>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Creationcode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Creationcode> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CreationcodesTable extends Table
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

        $this->setTable('creationcodes');
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
            ->scalar('code')
            ->maxLength('code', 10)
            ->allowEmptyString('code');

        $validator
            ->integer('num_usages')
            ->allowEmptyString('num_usages');

        return $validator;
    }
}
