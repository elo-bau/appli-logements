<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007124517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beneficiary_logement (id INT AUTO_INCREMENT NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary_logement_beneficiary (beneficiary_logement_id INT NOT NULL, beneficiary_id INT NOT NULL, INDEX IDX_2A5A1CD6B8923C50 (beneficiary_logement_id), INDEX IDX_2A5A1CD6ECCAAFA0 (beneficiary_id), PRIMARY KEY(beneficiary_logement_id, beneficiary_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary_logement_logement (beneficiary_logement_id INT NOT NULL, logement_id INT NOT NULL, INDEX IDX_201B320CB8923C50 (beneficiary_logement_id), INDEX IDX_201B320C58ABF955 (logement_id), PRIMARY KEY(beneficiary_logement_id, logement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beneficiary_logement_beneficiary ADD CONSTRAINT FK_2A5A1CD6B8923C50 FOREIGN KEY (beneficiary_logement_id) REFERENCES beneficiary_logement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary_logement_beneficiary ADD CONSTRAINT FK_2A5A1CD6ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary_logement_logement ADD CONSTRAINT FK_201B320CB8923C50 FOREIGN KEY (beneficiary_logement_id) REFERENCES beneficiary_logement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary_logement_logement ADD CONSTRAINT FK_201B320C58ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beneficiary_logement_beneficiary DROP FOREIGN KEY FK_2A5A1CD6B8923C50');
        $this->addSql('ALTER TABLE beneficiary_logement_logement DROP FOREIGN KEY FK_201B320CB8923C50');
        $this->addSql('DROP TABLE beneficiary_logement');
        $this->addSql('DROP TABLE beneficiary_logement_beneficiary');
        $this->addSql('DROP TABLE beneficiary_logement_logement');
    }
}
