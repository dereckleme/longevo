<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 18:03
 */
class PedidosService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * PedidosService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getListaPedidos()
    {
        $dql = $this->em->getRepository("AppBundle:Pedidos")->getListPedidos();

        return $dql;
    }

    /**
     * @param $id
     * @return bool
     */
    public function hasPedidoById($id)
    {
        $pedido = $this->em->getRepository("AppBundle:Pedidos")->find($id);

        if ($pedido) {
            return true;
        } else {
            return false;
        }
    }
}