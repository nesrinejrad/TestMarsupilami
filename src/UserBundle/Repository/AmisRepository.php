<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 12/09/2018
 * Time: 02:29
 */

namespace UserBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AmisRepository extends  EntityRepository
{
public  function  returnAmi($id,$idUser)
{
    $query=$this->getEntityManager()->createQuery(
        "select a from UseBundle:Amis a WHERE a.marsupilami=:idUse and a.marsupilamiAmis=:id "
    )->setParameter('id','%'.$id.'%')->setParameter('idUse' ,$idUser);
    return $query->getResult();
}
}