<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $sdt;

    /**
     * @var bool
     *
     * @ORM\Column(name="ThanhVien", type="boolean")
     */
    private $thanhvien;

}

