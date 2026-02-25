<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CodesClass Model
 *
 * @method \App\Model\Entity\CodesClas newEmptyEntity()
 * @method \App\Model\Entity\CodesClas newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CodesClas> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CodesClas get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CodesClas findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CodesClas patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CodesClas> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CodesClas|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CodesClas saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CodesClas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CodesClas>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CodesClas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CodesClas> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CodesClas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CodesClas>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CodesClas>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CodesClas> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CodesClassTable extends Table
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

        $this->setTable('codes_class');
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

        $validator
            ->requirePresence('id_class', 'create')
            ->notEmptyString('id_class');

        return $validator;
    }
}
