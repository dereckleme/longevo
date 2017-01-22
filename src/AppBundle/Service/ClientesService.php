<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 18:03
 */
class ClientesService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ClientesService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $name
     * @param $email
     * @return bool
     */
    public function hasClienteByNameAndEmail($name, $email)
    {
        $result = $this->em->getRepository("AppBundle:Clientes")->findBy(array(
           'nome' => $name,
           'email' => $email
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @param $email
     * @return bool|null|object
     */
    public function getClienteByNameAndEmail($name, $email)
    {
        $result = $this->em->getRepository("AppBundle:Clientes")->findOneBy(array(
            'nome' => $name,
            'email' => $email
        ));

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}