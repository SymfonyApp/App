<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HoaDon
 *
 * @ORM\Table(name="hoa_don")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HoaDonRepository")
 */
class HoaDon
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
     * @var \DateTime
     *
     * @ORM\Column(name="NgayDat", type="datetime")
     */
    private $ngaydat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="NgayXuat", type="datetime")
     */
    private $ngayxuat;

    /**
     * @var int
     *
     * @ORM\Column(name="TongTien", type="integer")
     */
    private $tongtien;
        /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="KhachHang")
     * @ORM\JoinColumn(name="id_kh", referencedColumnName="id")
     */
    private $id_kh;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="ChiTietHD", mappedBy="id_hd")
     */
    private $cthds;
    // ...

    public function __construct() {
        $this->cthds = new ArrayCollection();
    }

}

