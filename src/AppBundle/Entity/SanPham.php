<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="LoaiSp", inversedBy="sanphams")
     * @ORM\JoinColumn(name="id_LoaiSP", referencedColumnName="id")
     */

    private $id_loaisp;
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
     * One SanPham has Many Image.
     * @ORM\OneToMany(targetEntity="Images", mappedBy="id_sp")
     */
    private $images;

    public function __construct() {
        $this->images = new ArrayCollection();
    }

}