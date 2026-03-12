<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChaptersTags Model
 *
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsTo $Tags
 * @property \App\Model\Table\ChaptersTable&\Cake\ORM\Association\BelongsTo $Chapters
 *
 * @method \App\Model\Entity\ChaptersTag newEmptyEntity()
 * @method \App\Model\Entity\ChaptersTag newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ChaptersTag> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChaptersTag get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ChaptersTag findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ChaptersTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ChaptersTag> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChaptersTag|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ChaptersTag saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ChaptersTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChaptersTag>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChaptersTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChaptersTag> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChaptersTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChaptersTag>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChaptersTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChaptersTag> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ChaptersTagsTable extends Table
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

        $this->setTable('chapters_tags');
        $this->setDisplayField(['tag_id', 'chapter_id']);
        $this->setPrimaryKey(['tag_id', 'chapter_id']);

        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Chapters', [
            'foreignKey' => 'chapter_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['tag_id'], 'Tags'), ['errorField' => 'tag_id']);
        $rules->add($rules->existsIn(['chapter_id'], 'Chapters'), ['errorField' => 'chapter_id']);

        return $rules;
    }
}
