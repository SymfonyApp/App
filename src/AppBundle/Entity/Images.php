<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 */
class Images
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
     * @ORM\Column(name="TenHinh", type="string", length=255)
     */
    private $tenhinh;
    /**
     * @ORM\ManyToOne(targetEntity="SanPham", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sanpham;


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
    public function getTenhinh()
    {
        return $this->tenhinh;
    }

    /**
     * @param string $tenhinh
     *
     * @return self
     */
    public function setTenhinh($tenhinh)
    {
        $this->tenhinh = $tenhinh;

        return $this;
    }

    public function getSanpham(): SanPham
    {
        return $this->sanpham;
    }

    public function setSanpham(SanPham $sanpham)
    {
        $this->sanpham = $sanpham;

        return $this;
    }
}

