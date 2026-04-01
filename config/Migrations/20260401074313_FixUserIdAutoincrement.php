<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class FixUserIdAutoincrement extends BaseMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $this->execute('ALTER TABLE users MODIFY COLUMN id INT AUTO_INCREMENT');
    }

    /**
     * Down Method.
     *
     * @return void
     */
    public function down(): void
    {
        $this->execute('ALTER TABLE users MODIFY COLUMN id INT');
    }
}
