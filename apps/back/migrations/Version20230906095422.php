<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230906095422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Course table creation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE course (' .
            'uuid BINARY(16) NOT NULL, ' .
            'author_uuid BINARY(16) NOT NULL, ' .
            'name VARCHAR(255) NOT NULL, ' .
            'link VARCHAR(255) NOT NULL, ' .
            'created_at DATETIME NOT NULL, ' .
            'INDEX IDX_COURSE_AUTHOR (author_uuid), ' .
            'PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql(
            'ALTER TABLE course ADD CONSTRAINT FK_COURSE_USER ' .
            'FOREIGN KEY (author_uuid) REFERENCES user (uuid)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_COURSE_USER');
        $this->addSql('DROP TABLE course');
    }
}
