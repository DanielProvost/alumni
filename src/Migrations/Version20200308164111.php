<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308164111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, repository VARCHAR(512) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, degree_id INT NOT NULL, year_id INT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, notes VARCHAR(512) DEFAULT NULL, INDEX IDX_C11D7DD1B35C5756 (degree_id), INDEX IDX_C11D7DD140C1FEA7 (year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('ALTER TABLE user ADD slug VARCHAR(255) NOT NULL, ADD roles JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE user_promotion ADD CONSTRAINT FK_C1FDF035139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1B35C5756');
        $this->addSql('ALTER TABLE user_promotion DROP FOREIGN KEY FK_C1FDF035139DF194');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD140C1FEA7');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE year');
        $this->addSql('ALTER TABLE user DROP slug, DROP roles');
    }
}
