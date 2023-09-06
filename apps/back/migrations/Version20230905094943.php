<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230905094943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'User table creation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE user (' .
            'uuid VARCHAR(255) NOT NULL, ' .
            'email VARCHAR(180) NOT NULL, ' .
            'roles JSON NOT NULL, ' .
            'hashed_password VARCHAR(255) NOT NULL, ' .
            'username VARCHAR(180) NOT NULL, ' .
            'views_count INT DEFAULT NOT NULL, ' .
            'last_view INT DEFAULT NULL, ' .
            'UNIQUE INDEX UNIQ_USER_EMAIL (email), ' .
            'UNIQUE INDEX UNIQ_USER_USERNAME (username), ' .
            'PRIMARY KEY(uuid)) ' .
            'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
