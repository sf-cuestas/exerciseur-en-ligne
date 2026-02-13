<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersChapters Model
 *
 * @method \App\Model\Entity\UsersChapter newEmptyEntity()
 * @method \App\Model\Entity\UsersChapter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersChapter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersChapter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UsersChapter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UsersChapter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UsersChapter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersChapter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UsersChapter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UsersChapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersChapter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersChapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersChapter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersChapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersChapter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UsersChapter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UsersChapter> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UsersChaptersTable extends Table
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

        $this->setTable('users_chapters');
        $this->setDisplayField(['id_user', 'id_chapter']);
        $this->setPrimaryKey(['id_user', 'id_chapter']);
        $this->belongsTo('Users');
        $this->belongsTo('Chapters');
    }
}
