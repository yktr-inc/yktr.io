<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116143043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE grade_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE classroom_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE attendance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE promotion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE setting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE information_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exam_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, username VARCHAR(30) NOT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, birthdate DATE DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, status VARCHAR(50) NOT NULL, courses VARCHAR(255) DEFAULT NULL, attendances VARCHAR(255) DEFAULT NULL, grades VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4F85E0677 ON account (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4E7927C74 ON account (email)');
        $this->addSql('CREATE TABLE grade (id INT NOT NULL, user_id INT DEFAULT NULL, value DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_595AAE34A76ED395 ON grade (user_id)');
        $this->addSql('CREATE TABLE classroom (id INT NOT NULL, promotion_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_497D309D139DF194 ON classroom (promotion_id)');
        $this->addSql('CREATE TABLE attendance (id INT NOT NULL, user_id INT DEFAULT NULL, course_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6DE30D91A76ED395 ON attendance (user_id)');
        $this->addSql('CREATE INDEX IDX_6DE30D91591CC992 ON attendance (course_id)');
        $this->addSql('CREATE TABLE file (id INT NOT NULL, user_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8C9F3610A76ED395 ON file (user_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, type VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE classrooms_projects (project_id INT NOT NULL, classroom_id INT NOT NULL, PRIMARY KEY(project_id, classroom_id))');
        $this->addSql('CREATE INDEX IDX_960CC3E7166D1F9C ON classrooms_projects (project_id)');
        $this->addSql('CREATE INDEX IDX_960CC3E76278D5A8 ON classrooms_projects (classroom_id)');
        $this->addSql('CREATE TABLE promotion (id INT NOT NULL, title VARCHAR(50) NOT NULL, speciality VARCHAR(70) NOT NULL, started_at DATE NOT NULL, finished_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_169E6FB9A76ED395 ON course (user_id)');
        $this->addSql('CREATE TABLE setting (id INT NOT NULL, key VARCHAR(100) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F74B8988A90ABA9 ON setting (key)');
        $this->addSql('CREATE TABLE information (id INT NOT NULL, title VARCHAR(100) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE exam (id INT NOT NULL, classroom_id INT DEFAULT NULL, type VARCHAR(4) NOT NULL, name VARCHAR(100) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_38BBA6C66278D5A8 ON exam (classroom_id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309D139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D91A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D91591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classrooms_projects ADD CONSTRAINT FK_960CC3E7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classrooms_projects ADD CONSTRAINT FK_960CC3E76278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C66278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE grade DROP CONSTRAINT FK_595AAE34A76ED395');
        $this->addSql('ALTER TABLE attendance DROP CONSTRAINT FK_6DE30D91A76ED395');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F3610A76ED395');
        $this->addSql('ALTER TABLE course DROP CONSTRAINT FK_169E6FB9A76ED395');
        $this->addSql('ALTER TABLE classrooms_projects DROP CONSTRAINT FK_960CC3E76278D5A8');
        $this->addSql('ALTER TABLE exam DROP CONSTRAINT FK_38BBA6C66278D5A8');
        $this->addSql('ALTER TABLE classrooms_projects DROP CONSTRAINT FK_960CC3E7166D1F9C');
        $this->addSql('ALTER TABLE classroom DROP CONSTRAINT FK_497D309D139DF194');
        $this->addSql('ALTER TABLE attendance DROP CONSTRAINT FK_6DE30D91591CC992');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE grade_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE classroom_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE attendance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE promotion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE setting_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE information_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exam_id_seq CASCADE');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE classrooms_projects');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE information');
        $this->addSql('DROP TABLE exam');
    }
}
