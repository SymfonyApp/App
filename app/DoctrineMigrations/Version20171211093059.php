<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171211093059 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE loai_sp (id INT AUTO_INCREMENT NOT NULL, Tenloai VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chi_tiet_hd (id INT AUTO_INCREMENT NOT NULL, sanpham_id INT DEFAULT NULL, hoadon_id INT DEFAULT NULL, SL INT NOT NULL, TenSP VARCHAR(255) NOT NULL, DonGia INT NOT NULL, ThanhTien INT NOT NULL, UNIQUE INDEX UNIQ_1E0F9BFB8C5C419E (sanpham_id), INDEX IDX_1E0F9BFBEF46F396 (hoadon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hoa_don (id INT AUTO_INCREMENT NOT NULL, khachhang_id INT DEFAULT NULL, NgayDat DATETIME NOT NULL, NgayGiao DATETIME NOT NULL, TrangThai VARCHAR(255) NOT NULL, TongTien INT NOT NULL, INDEX IDX_EC1A79B1F2C5D4FC (khachhang_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, sanpham_id INT DEFAULT NULL, TenHinh VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A8C5C419E (sanpham_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE khach_hang (id INT AUTO_INCREMENT NOT NULL, TenKH VARCHAR(255) NOT NULL, Email VARCHAR(255) NOT NULL, DiaChi LONGTEXT DEFAULT NULL, SDT VARCHAR(255) DEFAULT NULL, ThanhVien TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE san_pham (id INT AUTO_INCREMENT NOT NULL, loaisp_id INT DEFAULT NULL, TenSP VARCHAR(255) NOT NULL, MoTaCT LONGTEXT NOT NULL, Gia INT NOT NULL, INDEX IDX_809F457C1BE2EB6B (loaisp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chi_tiet_hd ADD CONSTRAINT FK_1E0F9BFB8C5C419E FOREIGN KEY (sanpham_id) REFERENCES san_pham (id)');
        $this->addSql('ALTER TABLE chi_tiet_hd ADD CONSTRAINT FK_1E0F9BFBEF46F396 FOREIGN KEY (hoadon_id) REFERENCES hoa_don (id)');
        $this->addSql('ALTER TABLE hoa_don ADD CONSTRAINT FK_EC1A79B1F2C5D4FC FOREIGN KEY (khachhang_id) REFERENCES khach_hang (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8C5C419E FOREIGN KEY (sanpham_id) REFERENCES san_pham (id)');
        $this->addSql('ALTER TABLE san_pham ADD CONSTRAINT FK_809F457C1BE2EB6B FOREIGN KEY (loaisp_id) REFERENCES loai_sp (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE san_pham DROP FOREIGN KEY FK_809F457C1BE2EB6B');
        $this->addSql('ALTER TABLE chi_tiet_hd DROP FOREIGN KEY FK_1E0F9BFBEF46F396');
        $this->addSql('ALTER TABLE hoa_don DROP FOREIGN KEY FK_EC1A79B1F2C5D4FC');
        $this->addSql('ALTER TABLE chi_tiet_hd DROP FOREIGN KEY FK_1E0F9BFB8C5C419E');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8C5C419E');
        $this->addSql('DROP TABLE loai_sp');
        $this->addSql('DROP TABLE chi_tiet_hd');
        $this->addSql('DROP TABLE hoa_don');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE khach_hang');
        $this->addSql('DROP TABLE san_pham');
        $this->addSql('DROP TABLE user');
    }
}
