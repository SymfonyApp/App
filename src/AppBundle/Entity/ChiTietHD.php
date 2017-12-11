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
     * @ORM\OneToOne(targetEntity="SanPham")
     * @ORM\JoinColumn(name="sanpham_id", referencedColumnName="id", nullable=true )
     */
    private $sanpham_id;

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
        return $this->sanpham_id;
    }
}

