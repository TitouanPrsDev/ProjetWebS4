<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304144205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4B13ADB4');
        $this->addSql('DROP INDEX UNIQ_D34A04AD4B13ADB4 ON product');
        $this->addSql('ALTER TABLE product DROP characteristics_id');
        $this->addSql('ALTER TABLE product_characteristics ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_characteristics ADD CONSTRAINT FK_42BCB4CB4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42BCB4CB4584665A ON product_characteristics (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD characteristics_id INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4B13ADB4 FOREIGN KEY (characteristics_id) REFERENCES product_characteristics (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD4B13ADB4 ON product (characteristics_id)');
        $this->addSql('ALTER TABLE product_brand CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product_category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product_characteristics DROP FOREIGN KEY FK_42BCB4CB4584665A');
        $this->addSql('DROP INDEX UNIQ_42BCB4CB4584665A ON product_characteristics');
        $this->addSql('ALTER TABLE product_characteristics DROP product_id, CHANGE color color VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE profile_picture profile_picture VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
