<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240504182512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD restaurant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE35592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE35592D86 ON booking (restaurant_id_id)');
        $this->addSql('ALTER TABLE food_category ADD food_id_id INT NOT NULL, ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE food_category ADD CONSTRAINT FK_2E013E838E255BBD FOREIGN KEY (food_id_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE food_category ADD CONSTRAINT FK_2E013E839777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2E013E838E255BBD ON food_category (food_id_id)');
        $this->addSql('CREATE INDEX IDX_2E013E839777D11E ON food_category (category_id_id)');
        $this->addSql('ALTER TABLE menu ADD restaurant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9335592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9335592D86 ON menu (restaurant_id_id)');
        $this->addSql('ALTER TABLE menu_category ADD menu_id_id INT NOT NULL, ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_category ADD CONSTRAINT FK_2A1D5C57EEE8BD30 FOREIGN KEY (menu_id_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_category ADD CONSTRAINT FK_2A1D5C579777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2A1D5C57EEE8BD30 ON menu_category (menu_id_id)');
        $this->addSql('CREATE INDEX IDX_2A1D5C579777D11E ON menu_category (category_id_id)');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B1E7706E');
        $this->addSql('DROP INDEX IDX_16DB4F89B1E7706E ON picture');
        $this->addSql('ALTER TABLE picture CHANGE restaurant_id restaurant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8935592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F8935592D86 ON picture (restaurant_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE35592D86');
        $this->addSql('DROP INDEX IDX_E00CEDDE35592D86 ON booking');
        $this->addSql('ALTER TABLE booking DROP restaurant_id_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8935592D86');
        $this->addSql('DROP INDEX IDX_16DB4F8935592D86 ON picture');
        $this->addSql('ALTER TABLE picture CHANGE restaurant_id_id restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_16DB4F89B1E7706E ON picture (restaurant_id)');
        $this->addSql('ALTER TABLE menu_category DROP FOREIGN KEY FK_2A1D5C57EEE8BD30');
        $this->addSql('ALTER TABLE menu_category DROP FOREIGN KEY FK_2A1D5C579777D11E');
        $this->addSql('DROP INDEX IDX_2A1D5C57EEE8BD30 ON menu_category');
        $this->addSql('DROP INDEX IDX_2A1D5C579777D11E ON menu_category');
        $this->addSql('ALTER TABLE menu_category DROP menu_id_id, DROP category_id_id');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9335592D86');
        $this->addSql('DROP INDEX IDX_7D053A9335592D86 ON menu');
        $this->addSql('ALTER TABLE menu DROP restaurant_id_id');
        $this->addSql('ALTER TABLE food_category DROP FOREIGN KEY FK_2E013E838E255BBD');
        $this->addSql('ALTER TABLE food_category DROP FOREIGN KEY FK_2E013E839777D11E');
        $this->addSql('DROP INDEX IDX_2E013E838E255BBD ON food_category');
        $this->addSql('DROP INDEX IDX_2E013E839777D11E ON food_category');
        $this->addSql('ALTER TABLE food_category DROP food_id_id, DROP category_id_id');
    }
}
