<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Many Image have One SanPham.
     * @ORM\ManyToOne(targetEntity="SanPham", inversedBy="images")
     * @ORM\JoinColumn(name="id_SP", referencedColumnName="id")
     */
    private $id_sp;
}

