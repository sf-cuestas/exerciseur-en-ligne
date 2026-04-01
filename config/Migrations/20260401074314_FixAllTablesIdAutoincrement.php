<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class FixAllTablesIdAutoincrement extends BaseMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $this->execute('ALTER TABLE chapters MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->execute('ALTER TABLE classses MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->execute('ALTER TABLE exercises MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->execute('ALTER TABLE results MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->execute('ALTER TABLE tags MODIFY COLUMN id INT AUTO_INCREMENT');
    }

    /**
     * Down Method.
     *
     * @return void
     */
    public function down(): void
    {
        $this->execute('ALTER TABLE chapters MODIFY COLUMN id INT');
        $this->execute('ALTER TABLE classses MODIFY COLUMN id INT');
        $this->execute('ALTER TABLE exercises MODIFY COLUMN id INT');
        $this->execute('ALTER TABLE results MODIFY COLUMN id INT');
        $this->execute('ALTER TABLE tags MODIFY COLUMN id INT');
    }
}
