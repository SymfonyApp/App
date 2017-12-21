<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChiTietHD
 *
 * @ORM\Table(name="chi_tiet_hd")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChiTietHDRepository")
 */
class ChiTietHD
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="SL", type="integer")
     */
    private $sl;
    /**
     * @var string
     *
     * @ORM\Column(name="TenSP", type="string")
     */
    private $tensp;
    /**
     * @var int
     *
     * @ORM\Column(name="DonGia", type="integer")
     */
    private $dongia;

    /**
     * @var int
     *
     * @ORM\Column(name="ThanhTien", type="integer")
     */
    private $thanhtien;

        /**
     * @ORM\ManyToOne(targetEntity="SanPham")
     * @ORM\JoinColumn(nullable=true )
     */
    public $sanpham;

    /**
     * @ORM\ManyToOne(targetEntity="HoaDon", inversedBy="cthds")
     * @ORM\JoinColumn(nullable=true)
     */
    private $hoadon;
    public function getHD(): HoaDon
    {
        return $this->hoadon;
    }

    public function setHD(HoaDon $hoadon)
    {
        $this->hoadon = $hoadon;
    }
    public function getSP(): SanPham
    {
        return $this->sanpham;
    }
    public function setSP(SanPham $sanpham = null)
    {
        $this->sanpham=$sanpham;
    }

    /**
     * @return int
     */
    public function getSl()
    {
        return $this->sl;
    }

    /**
     * @param int $sl
     *
     * @return self
     */
    public function setSl($sl)
    {
        $this->sl = $sl;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTensp()
    {
        return $this->tensp;
    }

    /**
     * @param string $tensp
     *
     * @return self
     */
    public function setTensp($tensp)
    {
        $this->tensp = $tensp;

        return $this;
    }

    /**
     * @return int
     */
    public function getDongia()
    {
        return $this->dongia;
    }

    /**
     * @param int $dongia
     *
     * @return self
     */
    public function setDongia($dongia)
    {
        $this->dongia = $dongia;

        return $this;
    }

    /**
     * @return int
     */
    public function getThanhtien()
    {
        return $this->thanhtien;
    }

    /**
     * @param int $thanhtien
     *
     * @return self
     */
    public function setThanhtien($thanhtien)
    {
        $this->thanhtien = $thanhtien;

        return $this;
    }
}

