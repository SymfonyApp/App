<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Many CTHD has One HD.
     * @ORM\ManyToOne(targetEntity="HoaDon", inversedBy="cthds")
     * @ORM\JoinColumn(name="id_hd", referencedColumnName="id")
     */
    private $id_hd;
        /**
     * @ORM\OneToOne(targetEntity="SanPham")
     * @ORM\JoinColumn(name="id_sp", referencedColumnName="id")
     */
    private $id_sp;
}

