<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171129155331 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chi_tiet_hd (id INT AUTO_INCREMENT NOT NULL, id_hd INT DEFAULT NULL, id_sp INT DEFAULT NULL, SL INT NOT NULL, DonGia INT NOT NULL, ThanhTien INT NOT NULL, INDEX IDX_1E0F9BFB665FAF16 (id_hd), UNIQUE INDEX UNIQ_1E0F9BFBD5B3B0F1 (id_sp), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hoa_don (id INT AUTO_INCREMENT NOT NULL, id_kh INT DEFAULT NULL, NgayDat DATETIME NOT NULL, NgayXuat DATETIME NOT NULL, TongTien INT NOT NULL, UNIQUE INDEX UNIQ_EC1A79B144C4B0FE (id_kh), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, TenHinh VARCHAR(255) NOT NULL, id_SP INT DEFAULT NULL, INDEX IDX_E01FBE6A7B59B49B (id_SP), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE khach_hang (id INT AUTO_INCREMENT NOT NULL, TenKH VARCHAR(255) NOT NULL, Email VARCHAR(255) NOT NULL, DiaChi LONGTEXT DEFAULT NULL, SDT VARCHAR(255) DEFAULT NULL, ThanhVien TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kho (id INT AUTO_INCREMENT NOT NULL, SL INT NOT NULL, SLCon INT NOT NULL, id_SP INT DEFAULT NULL, UNIQUE INDEX UNIQ_CBEA60B57B59B49B (id_SP), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loai_sp (id INT AUTO_INCREMENT NOT NULL, Tenloai VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE san_pham (id INT AUTO_INCREMENT NOT NULL, TenSP VARCHAR(255) NOT NULL, HDH VARCHAR(255) NOT NULL, CameraTruoc INT NOT NULL, CameraSau INT NOT NULL, Ram INT NOT NULL, Memory INT NOT NULL, Pin INT NOT NULL, CPU VARCHAR(255) NOT NULL, ManHinh VARCHAR(255) NOT NULL, Color VARCHAR(255) NOT NULL, MoTaCT LONGTEXT NOT NULL, Gia INT NOT NULL, id_LoaiSP INT DEFAULT NULL, INDEX IDX_809F457CCA6C016F (id_LoaiSP), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chi_tiet_hd ADD CONSTRAINT FK_1E0F9BFB665FAF16 FOREIGN KEY (id_hd) REFERENCES hoa_don (id)');
        $this->addSql('ALTER TABLE chi_tiet_hd ADD CONSTRAINT FK_1E0F9BFBD5B3B0F1 FOREIGN KEY (id_sp) REFERENCES san_pham (id)');
        $this->addSql('ALTER TABLE hoa_don ADD CONSTRAINT FK_EC1A79B144C4B0FE FOREIGN KEY (id_kh) REFERENCES khach_hang (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A7B59B49B FOREIGN KEY (id_SP) REFERENCES san_pham (id)');
        $this->addSql('ALTER TABLE kho ADD CONSTRAINT FK_CBEA60B57B59B49B FOREIGN KEY (id_SP) REFERENCES san_pham (id)');
        $this->addSql('ALTER TABLE san_pham ADD CONSTRAINT FK_809F457CCA6C016F FOREIGN KEY (id_LoaiSP) REFERENCES loai_sp (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chi_tiet_hd DROP FOREIGN KEY FK_1E0F9BFB665FAF16');
        $this->addSql('ALTER TABLE hoa_don DROP FOREIGN KEY FK_EC1A79B144C4B0FE');
        $this->addSql('ALTER TABLE san_pham DROP FOREIGN KEY FK_809F457CCA6C016F');
        $this->addSql('ALTER TABLE chi_tiet_hd DROP FOREIGN KEY FK_1E0F9BFBD5B3B0F1');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A7B59B49B');
        $this->addSql('ALTER TABLE kho DROP FOREIGN KEY FK_CBEA60B57B59B49B');
        $this->addSql('DROP TABLE chi_tiet_hd');
        $this->addSql('DROP TABLE hoa_don');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE khach_hang');
        $this->addSql('DROP TABLE kho');
        $this->addSql('DROP TABLE loai_sp');
        $this->addSql('DROP TABLE san_pham');
        $this->addSql('DROP TABLE user');
    }
}
