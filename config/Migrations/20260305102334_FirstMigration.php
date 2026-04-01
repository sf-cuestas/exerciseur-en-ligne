<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class FirstMigration extends BaseMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('chapters', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('visible', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('level', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('secondstimelimit', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('corrend', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('tries', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('class', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('weight', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addIndex(
                $this->index('class')
                    ->setName('chapters_classses_id_fk')
            )
            ->create();

        $this->table('chapters_tags', ['id' => false, 'primary_key' => ['tag_id', 'chapter_id']])
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('chapter_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('classses', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('codes_class')
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('num_usages', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('id_class', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('id_class')
                    ->setName('users_codes_class_FK')
            )
            ->create();

        $this->table('creationcodes')
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('num_usages', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('id_admin', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('id_admin')
                    ->setName('users_creation_code_FK')
            )
            ->create();

        $this->table('exercises', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('random', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('coef', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('timesec', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('tries', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('content', 'text', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('ansdef', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('showans', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('grade', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('id_chapter', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('id_chapter')
                    ->setName('FK_exercise__chapter')
            )
            ->create();

        $this->table('results', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('id_subject', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('id_user', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('id_exercise', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('id_class', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('grade', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addIndex(
                $this->index('id_subject')
                    ->setName('FK_result__chapter')
            )
            ->addIndex(
                $this->index('id_user')
                    ->setName('FK_result__user')
            )
            ->addIndex(
                $this->index('id_exercise')
                    ->setName('FK_result__exercise')
            )
            ->addIndex(
                $this->index('id_class')
                    ->setName('FK_result__class')
            )
            ->create();

        $this->table('tags', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('tag', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('weight', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->create();

        $this->table('users', ['id' => true, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', [
                'autoincrement' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('surname', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('password', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => 'student',
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('schoolId', 'string', [
                'default' => null,
                'limit' => 15,
                'null' => true,
            ])
            ->addIndex(
                $this->index('email')
                    ->setName('mail')
                    ->setType('unique')
            )
            ->create();

        $this->table('users_chapters', ['id' => false, 'primary_key' => ['id_user', 'id_chapter']])
            ->addColumn('id_user', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('id_chapter', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('users_classses', ['id' => false, 'primary_key' => ['id_user', 'id_class']])
            ->addColumn('id_user', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('id_class', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('responsible', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('joined_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('id_class')
                    ->setName('FK_inclass__class')
            )
            ->create();

        $this->table('users_exercises', ['id' => false, 'primary_key' => ['id_user', 'id_exercise']])
            ->addColumn('id_user', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('id_exercise', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('answer', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('grade', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addIndex(
                $this->index('id_exercise')
                    ->setName('users_exercises_exercise_FK')
            )
            ->create();

        $this->table('chapters')
            ->addForeignKey(
                $this->foreignKey('class')
                    ->setReferencedTable('classses')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('chapters_classses_id_fk')
            )
            ->update();

        $this->table('codes_class')
            ->addForeignKey(
                $this->foreignKey('id_class')
                    ->setReferencedTable('classses')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('users_codes_class_FK')
            )
            ->update();

        $this->table('creationcodes')
            ->addForeignKey(
                $this->foreignKey('id_admin')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('users_creation_code_FK')
            )
            ->update();

        $this->table('exercises')
            ->addForeignKey(
                $this->foreignKey('id_chapter')
                    ->setReferencedTable('chapters')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_exercise__chapter')
            )
            ->update();

        $this->table('results')
            ->addForeignKey(
                $this->foreignKey('id_user')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_result__user')
            )
            ->addForeignKey(
                $this->foreignKey('id_exercise')
                    ->setReferencedTable('exercises')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_result__exercise')
            )
            ->addForeignKey(
                $this->foreignKey('id_class')
                    ->setReferencedTable('classses')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_result__class')
            )
            ->addForeignKey(
                $this->foreignKey('id_subject')
                    ->setReferencedTable('chapters')
                    ->setReferencedColumns('id')
                    ->setOnDelete('SET_NULL')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_result__chapter')
            )
            ->update();

        $this->table('users_classses')
            ->addForeignKey(
                $this->foreignKey('id_class')
                    ->setReferencedTable('classses')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_inclass__class')
            )
            ->addForeignKey(
                $this->foreignKey('id_user')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('RESTRICT')
                    ->setOnUpdate('RESTRICT')
                    ->setName('FK_inClass__user')
            )
            ->update();

        $this->table('users_exercises')
            ->addForeignKey(
                $this->foreignKey('id_user')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('users_exercises_users_FK')
            )
            ->addForeignKey(
                $this->foreignKey('id_exercise')
                    ->setReferencedTable('exercises')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('users_exercises_exercise_FK')
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('chapters')
            ->dropForeignKey(
                'class'
            )->save();

        $this->table('codes_class')
            ->dropForeignKey(
                'id_class'
            )->save();

        $this->table('creationcodes')
            ->dropForeignKey(
                'id_admin'
            )->save();

        $this->table('exercises')
            ->dropForeignKey(
                'id_chapter'
            )->save();

        $this->table('results')
            ->dropForeignKey(
                'id_user'
            )
            ->dropForeignKey(
                'id_exercise'
            )
            ->dropForeignKey(
                'id_class'
            )
            ->dropForeignKey(
                'id_subject'
            )->save();

        $this->table('users_classses')
            ->dropForeignKey(
                'id_class'
            )
            ->dropForeignKey(
                'id_user'
            )->save();

        $this->table('users_exercises')
            ->dropForeignKey(
                'id_user'
            )
            ->dropForeignKey(
                'id_exercise'
            )->save();

        $this->table('chapters')->drop()->save();
        $this->table('chapters_tags')->drop()->save();
        $this->table('classses')->drop()->save();
        $this->table('codes_class')->drop()->save();
        $this->table('creationcodes')->drop()->save();
        $this->table('exercises')->drop()->save();
        $this->table('results')->drop()->save();
        $this->table('tags')->drop()->save();
        $this->table('users')->drop()->save();
        $this->table('users_chapters')->drop()->save();
        $this->table('users_classses')->drop()->save();
        $this->table('users_exercises')->drop()->save();
    }
}
