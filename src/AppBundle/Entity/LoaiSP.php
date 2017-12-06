<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoaiSP
 *
 * @ORM\Table(name="loai_sp")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoaiSPRepository")
 */
class LoaiSP
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
     * @ORM\Column(name="Tenloai", type="string", length=255)
     */
    private $tenloai;

    /**
     * @ORM\OneToMany(targetEntity="SanPham", mappedBy="id_loaisp")
     */
    private $sanphams;

    public function __construct()
    {
        $this->sanphams = new ArrayCollection();
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
    public function getTenloai()
    {
        return $this->tenloai;
    }

    /**
     * @param string $tenloai
     *
     * @return self
     */
    public function setTenloai($tenloai)
    {
        $this->tenloai = $tenloai;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSanphams()
    {
        return $this->sanphams;
    }

    /**
     * @param mixed $sanphams
     *
     * @return self
     */
    public function setSanphams($sanphams)
    {
        $this->sanphams = $sanphams;

        return $this;
    }
}

