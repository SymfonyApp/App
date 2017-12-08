<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * SanPham
 *
 * @ORM\Table(name="san_pham")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SanPhamRepository")
 */
class SanPham
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
     * @ORM\ManyToOne(targetEntity="LoaiSP", inversedBy="sanphams")
     * @ORM\JoinColumn(nullable=true)
     */
    private $loaisp;

    /**
     * @var string
     *
     * @ORM\Column(name="TenSP", type="string", length=255)
     */
    private $tensp;
    /**
     * @var string
     *
     * @ORM\Column(name="MoTaCT", type="text")
     */
    private $mota;
    /**
     * @var int
     *
     * @ORM\Column(name="Gia", type="integer")
     */
    private $gia;
    /**
     * @ORM\OneToMany(targetEntity="Images", mappedBy="sanpham")
     */
    public $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages()
    {
        return $this->image;
    }
    public function getLoaiSP(): LoaiSP
    {
        return $this->loaisp;
    }

    public function setLoaiSP(LoaiSP $loaisp)
    {
        $this->loaisp = $loaisp;
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
     * @return mixed
     */
    public function getIdLoaisp()
    {
        return $this->id_loaisp;
    }

    /**
     * @param int $id_loaisp
     *
     * @return self
     */
    public function setIdLoaisp($id_loaisp)
    {
        $this->id_loaisp = $id_loaisp;

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
     * @return string
     */
    public function getMota()
    {
        return $this->mota;
    }

    /**
     * @param string $mota
     *
     * @return self
     */
    public function setMota($mota)
    {
        $this->mota = $mota;

        return $this;
    }

    /**
     * @return int
     */
    public function getGia()
    {
        return $this->gia;
    }

    /**
     * @param int $gia
     *
     * @return self
     */
    public function setGia($gia)
    {
        $this->gia = $gia;

        return $this;
    }

}