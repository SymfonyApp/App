<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kho
 *
 * @ORM\Table(name="kho")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KhoRepository")
 */
class Kho
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
     * @ORM\OneToOne(targetEntity="SanPham")
     * @ORM\JoinColumn(name="id_SP", referencedColumnName="id")
     */
    private $id_sp;
    /**
     * @var int
     *
     * @ORM\Column(name="SL", type="integer")
     */
    private $sl;

    /**
     * @var int
     *
     * @ORM\Column(name="SLCon", type="integer")
     */
    private $slcon;

}

