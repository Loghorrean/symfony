<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class CreatingAuthorTable extends AbstractMigration {
    public function getDescription() : string {
        return 'Creating author table';
    }

    public function up(Schema $schema) : void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE author (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(35) NOT NULL UNIQUE)");
    }

    public function down(Schema $schema) : void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE author');
    }
}
