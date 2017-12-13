<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(name="NgayGiao", type="datetime")
     */
    private $ngaygiao;
    /**
     * @var string
     *
     * @ORM\Column(name="TrangThai", type="string")
     */
    private $trangthai;
    /**
     * @var int
     *
     * @ORM\Column(name="TongTien", type="integer")
     */
    private $tongtien;
    /**
     * @ORM\OneToMany(targetEntity="ChiTietHD", mappedBy="hoadon")
     */
    public $cthds;

    public function __construct()
    {
        $this->cthds = new ArrayCollection();
    }

    /**
     * @return Collection|ChiTietHD[]
     */
    public function getcthds()
    {
        return $this->cthds;
    }
    /**
     * @ORM\ManyToOne(targetEntity="KhachHang", inversedBy="hoadons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $khachhang;
    public function getKH(): KhachHang
    {
        return $this->khachhang;
    }

    public function setKH(KhachHang $khachhang = null)
    {
        $this->khachhang = $khachhang;
    }
}

