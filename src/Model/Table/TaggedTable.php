<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tagged Model
 *
 * @method \App\Model\Entity\Tagged newEmptyEntity()
 * @method \App\Model\Entity\Tagged newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tagged> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tagged get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tagged findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tagged patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tagged> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tagged|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tagged saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tagged>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tagged>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tagged>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tagged> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tagged>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tagged>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tagged>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tagged> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TaggedTable extends Table
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

        $this->setTable('tagged');
        $this->setDisplayField(['tag_id', 'chapter_id']);
        $this->setPrimaryKey(['tag_id', 'chapter_id']);
    }
}
