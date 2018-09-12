<?php

namespace UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Amis;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class DefaultController extends Controller

{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:Accueil.html.twig');

    }

    function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($id);
        $form = $this->createForm(UserType::class, $user);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('UserBundle:Default:Update.html.twig',
            array('f' => $form->createView()));
    }


    public function listeAmisAction( $id)
    {
        $em = $this->getDoctrine()->getManager();//instance de l rorm
        $amis = $em->getRepository('UserBundle:Amis')->findBy(array('marsupilami' => $id));
    var_dump($amis);

        return $this->render('UserBundle:Default:listeAmis.html.twig'
            , array('m' => $amis

            ));
    }

    public function listeMArsuAction($id)
    {

        $em = $this->getDoctrine()->getManager();//instance de l rorm
        $users = $em->getRepository('UserBundle:User')->findAll();

        $userAmi=$em->getRepository('UserBundle:Amis')->findBy(array('marsupilami' => $id));
        $marsus3= array();
        if($userAmi==null)
        {
            $marsus3=$users;
        }
        foreach ($userAmi as $ami)
        {
            $user=$em->getRepository('UserBundle:User')->find($ami->marsupilamiAmis);
            $index = array_search($user, $users, false);
            $marsus = array_slice($users, 0, $index, false);
            $marsus2 = array_slice($users, $index + 1, 20, false);
            $marsus3 = array_merge($marsus, $marsus2);

        }
    var_dump($marsus3);
        $user = $em->getRepository('UserBundle:User')->find($id);
        $index = array_search($user, $users, false);
        // var_dump($index);
         //var_dump($user);
        //var_dump($users);

        $marsus4 = array_slice($marsus3, 0, $index, false);
        $marsus5 = array_slice($marsus3, $index + 1, 20, false);
        $marsus6 = array_merge($marsus4,$marsus5);
        var_dump($marsus4);
        var_dump($marsus5);
        return $this->render('UserBundle:Default:listeMArsu.html.twig'
            , array('m' => $marsus6
            ));
    }

    public function ajoutAmiAction($id,$idUser)
{
    $em=$this->getDoctrine()->getManager();
    $ami1= new Amis();
    $ami=$em->getRepository('UserBundle:User')->find($id);
    $user=$em->getRepository('UserBundle:User')->find($idUser);
    $ami1->setMarsupilami($user);
    $ami1->setMarsupilamiAmis($ami);
    $em->persist($ami1);
    $em->flush();
    return $this->render('UserBundle:Default:EspaceMarsu.html.twig');
}
    public function suppAmiAction($id,$idUser)
    {$m=$this->getDoctrine()->getManager();


        $users=$m->getRepository('UserBundle:Amis')->findBy(array('marsupilami'=>$idUser,'marsupilamiAmis'=>$id));
        var_dump($users);

        $user=array_pop($users);
        var_dump($user);
        $m->remove($user);
        $m->flush();
        return $this->render('UserBundle:Default:EspaceMarsu.html.twig');

    }




}
