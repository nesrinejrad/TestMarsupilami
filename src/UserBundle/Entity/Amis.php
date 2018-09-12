<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/09/2018
 * Time: 15:26
 */

namespace UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="AmisListe")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AmisRepository")
 */
class Amis
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User" , inversedBy="Amis")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $marsupilami;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User" , inversedBy="Amis")
     * @ORM\JoinColumn(name="Amis_id", referencedColumnName="id")
     *
     */
    public $marsupilamiAmis;

    /**
     * @return mixed
     */
    public function getMarsupilami()
    {
        return $this->marsupilami;
    }

    /**
     * @param mixed $marsupilami
     */
    public function setMarsupilami($marsupilami)
    {
        $this->marsupilami = $marsupilami;
    }

    /**
     * @return mixed
     */
    public function getMarsupilamiAmis()
    {
        return $this->marsupilamiAmis;
    }

    /**
     * @param mixed $marsupilamiAmis
     */
    public function setMarsupilamiAmis($marsupilamiAmis)
    {
        $this->marsupilamiAmis = $marsupilamiAmis;
    }



}