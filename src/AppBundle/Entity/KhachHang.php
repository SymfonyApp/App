<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * KhachHang
 *
 * @ORM\Table(name="khach_hang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KhachHangRepository")
 */
class KhachHang
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
     * @var string
     *
     * @ORM\Column(name="TenKH", type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $tenkh;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="DiaChi", type="text", nullable=true)
     */
    private $diachi;

    /**
     * @var string
     *
     * @ORM\Column(name="SDT", type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^[0-9]*$/", message="number_only") 
     * @Assert\Length(
     *      min = 10,
     *      max = 11,
     *      minMessage = "Thấp nhất {{ limit }} số",
     *      maxMessage = "Nhiều nhất {{ limit }} số"
     * )
     */
    private $sdt;

    /**
     * @var bool
     *
     * @ORM\Column(name="ThanhVien", type="boolean")
     */
    private $thanhvien;
    /**
     * @ORM\OneToMany(targetEntity="HoaDon", mappedBy="khachhang")
     */
    public $hoadons;

    public function __construct()
    {
        $this->hoadons = new ArrayCollection();
    }

    /**
     * @return Collection|HoaDon[]
     */
    public function gethds()
    {
        return $this->hoadons;
    }
    public function removeHD(HoaDon $hoadon)
    {
        $this->hoadons->removeElement($hoadon);
        $hoadon->setKH(null);
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
    public function getTenkh()
    {
        return $this->tenkh;
    }

    /**
     * @param string $tenkh
     *
     * @return self
     */
    public function setTenkh($tenkh)
    {
        $this->tenkh = $tenkh;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiachi()
    {
        return $this->diachi;
    }

    /**
     * @param string $diachi
     *
     * @return self
     */
    public function setDiachi($diachi)
    {
        $this->diachi = $diachi;

        return $this;
    }

    /**
     * @return string
     */
    public function getSdt()
    {
        return $this->sdt;
    }

    /**
     * @param string $sdt
     *
     * @return self
     */
    public function setSdt($sdt)
    {
        $this->sdt = $sdt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isThanhvien()
    {
        return $this->thanhvien;
    }

    /**
     * @param bool $thanhvien
     *
     * @return self
     */
    public function setThanhvien($thanhvien)
    {
        $this->thanhvien = $thanhvien;

        return $this;
    }
}

