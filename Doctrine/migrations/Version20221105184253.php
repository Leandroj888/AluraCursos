<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105184253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Course (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Phone (id SERIAL NOT NULL, student_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_858EB8D9CB944F1A ON Phone (student_id)');
        $this->addSql('CREATE TABLE Student (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE student_course (student_id INT NOT NULL, course_id INT NOT NULL, PRIMARY KEY(student_id, course_id))');
        $this->addSql('CREATE INDEX IDX_98A8B739CB944F1A ON student_course (student_id)');
        $this->addSql('CREATE INDEX IDX_98A8B739591CC992 ON student_course (course_id)');
        $this->addSql('ALTER TABLE Phone ADD CONSTRAINT FK_858EB8D9CB944F1A FOREIGN KEY (student_id) REFERENCES Student (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739CB944F1A FOREIGN KEY (student_id) REFERENCES Student (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739591CC992 FOREIGN KEY (course_id) REFERENCES Course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE Phone DROP CONSTRAINT FK_858EB8D9CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP CONSTRAINT FK_98A8B739CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP CONSTRAINT FK_98A8B739591CC992');
        $this->addSql('DROP TABLE Course');
        $this->addSql('DROP TABLE Phone');
        $this->addSql('DROP TABLE Student');
        $this->addSql('DROP TABLE student_course');
    }
}
