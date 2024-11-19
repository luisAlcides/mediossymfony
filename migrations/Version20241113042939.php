<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113042939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE solicitud (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, medio_id INT DEFAULT NULL, fecha_uso DATE NOT NULL, hora_inicio TIME NOT NULL, hora_fin TIME NOT NULL, estado VARCHAR(50) NOT NULL, datetime DATETIME NOT NULL, INDEX IDX_96D27CC0DB38439E (usuario_id), INDEX IDX_96D27CC0A40AA46 (medio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0A40AA46 FOREIGN KEY (medio_id) REFERENCES medio (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0DB38439E');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0A40AA46');
        $this->addSql('DROP TABLE solicitud');
    }
}
