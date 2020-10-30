<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class CreatingBookTable extends AbstractMigration {
    public function getDescription() : string {
        return 'Creating book table';
    }

    public function up(Schema $schema) : void {
        $this->addSql("CREATE TABLE book (id INT PRIMARY KEY AUTO_INCREMENT, author_id INT NOT NULL, name varchar(35) NOT NULL, date_of_publish DATE NOT NULL, FOREIGN KEY (author_id) REFERENCES author(id))");
    }

    public function down(Schema $schema) : void {
        $this->addSql('DROP TABLE book');
    }
}
