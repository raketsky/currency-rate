<?php declare(strict_types=1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200415104007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Currency Rate table creating';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE currency_rate (
            id INT AUTO_INCREMENT NOT NULL,
            name CHAR(3) NOT NULL,
            price DECIMAL(13,8) NOT NULL,
            date DATE NOT NULL,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
            COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency_rate ADD INDEX (date)');
        $this->addSql('ALTER TABLE currency_rate ADD UNIQUE INDEX (name, date)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE currency_rate');
    }
}
