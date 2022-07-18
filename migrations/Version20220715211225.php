<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715211225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cast (id INT UNSIGNED AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cast_movie (cast_id INT UNSIGNED NOT NULL, movie_id INT NOT NULL, INDEX IDX_8E1E9FF927B5E40F (cast_id), INDEX IDX_8E1E9FF98F93B6FC (movie_id), PRIMARY KEY(cast_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_movie (rating_id INT UNSIGNED NOT NULL, movie_id INT NOT NULL, INDEX IDX_8048FD53A32EFC6 (rating_id), INDEX IDX_8048FD538F93B6FC (movie_id), PRIMARY KEY(rating_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cast_movie ADD CONSTRAINT FK_8E1E9FF927B5E40F FOREIGN KEY (cast_id) REFERENCES cast (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cast_movie ADD CONSTRAINT FK_8E1E9FF98F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_movie ADD CONSTRAINT FK_8048FD53A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_movie ADD CONSTRAINT FK_8048FD538F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cast_movie DROP FOREIGN KEY FK_8E1E9FF927B5E40F');
        $this->addSql('ALTER TABLE rating_movie DROP FOREIGN KEY FK_8048FD53A32EFC6');
        $this->addSql('DROP TABLE cast');
        $this->addSql('DROP TABLE cast_movie');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE rating_movie');
    }
}
