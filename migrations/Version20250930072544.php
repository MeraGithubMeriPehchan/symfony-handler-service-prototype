<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930072544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_name VARCHAR(255) NOT NULL, amount NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_audit (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, action VARCHAR(20) NOT NULL, action_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('DROP TRIGGER IF EXISTS after_orders_insert');
        $this->addSql('DROP TRIGGER IF EXISTS after_orders_update');
        $this->addSql('DROP TRIGGER IF EXISTS after_orders_delete');

        $this->addSql("CREATE TRIGGER after_orders_insert AFTER INSERT ON orders FOR EACH ROW INSERT INTO order_audit (order_id, action, action_time) VALUES (NEW.id, 'CREATED', NOW())");
        $this->addSql("CREATE TRIGGER after_orders_update AFTER UPDATE ON orders FOR EACH ROW INSERT INTO order_audit (order_id, action, action_time) VALUES (NEW.id, 'UPDATED', NOW())");
        $this->addSql("CREATE TRIGGER after_orders_delete AFTER DELETE ON orders FOR EACH ROW INSERT INTO order_audit (order_id, action, action_time) VALUES (OLD.id, 'DELETED', NOW())");
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
