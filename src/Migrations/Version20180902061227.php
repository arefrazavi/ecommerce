<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902061227 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variant (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, color VARCHAR(255) NOT NULL, price NUMERIC(15, 0) NOT NULL, INDEX IDX_F143BFAD4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFAD4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE variant DROP FOREIGN KEY FK_F143BFAD4584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE `users`');
        $this->addSql('DROP TABLE variant');
    }
}
