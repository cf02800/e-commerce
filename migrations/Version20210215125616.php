<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215125616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE type_article_id type_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client DROP confirmation_token, DROP actif, DROP password_token');
        $this->addSql('ALTER TABLE commande CHANGE client_id client_id INT DEFAULT NULL, CHANGE mode_paiement_id mode_paiement_id INT DEFAULT NULL, CHANGE statut_commande_id statut_commande_id INT DEFAULT NULL, CHANGE adresse_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE migration_versions CHANGE version version VARCHAR(14) NOT NULL');
        $this->addSql('ALTER TABLE type_article CHANGE categorie_id categorie_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE type_article_id type_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD confirmation_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD actif TINYINT(1) NOT NULL, ADD password_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande CHANGE client_id client_id INT NOT NULL, CHANGE mode_paiement_id mode_paiement_id INT NOT NULL, CHANGE adresse_id adresse_id INT NOT NULL, CHANGE statut_commande_id statut_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE migration_versions CHANGE version version VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE type_article CHANGE categorie_id categorie_id INT NOT NULL');
    }
}
