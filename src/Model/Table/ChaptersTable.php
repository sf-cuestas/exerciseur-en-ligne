<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chapters Model
 *
 * @property \App\Model\Table\TaggedTable&\Cake\ORM\Association\HasMany $Tagged
 *
 * @method \App\Model\Entity\Chapter newEmptyEntity()
 * @method \App\Model\Entity\Chapter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Chapter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chapter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Chapter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Chapter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Chapter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chapter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Chapter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Chapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chapter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chapter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chapter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chapter> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ChaptersTable extends Table
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

        $this->setTable('chapters');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Tagged', [
            'foreignKey' => 'chapter_id',
        ]);
        $this->hasMany('UsersChapters');
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
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('level')
            ->notEmptyString('level');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('secondstimelimit')
            ->allowEmptyString('secondstimelimit');

        $validator
            ->integer('corrend')
            ->allowEmptyString('corrend');

        $validator
            ->integer('tries')
            ->allowEmptyString('tries');

        $validator
            ->allowEmptyString('class');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        $validator
            ->integer('weight')
            ->allowEmptyString('weight');

        return $validator;
    }
}
