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
    CONST SEARCH_BY_EMAIL = "email";
    CONST SEARCH_BY_PEDIDO = "pedido";

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
    public function getListaPedidos($data)
    {
        if (isset($data['buscarTexto'])) {
            if (isset($data['option']) && $data['option'] == $this::SEARCH_BY_EMAIL) {
                $dql = $this->em->getRepository("AppBundle:Pedidos")->getListPedidosByEmail($data['buscarTexto']);
            } else if (isset($data['option']) && $data['option'] == $this::SEARCH_BY_PEDIDO && is_numeric($data['buscarTexto'])) {
                $dql = $this->em->getRepository("AppBundle:Pedidos")->getListPedidosById($data['buscarTexto']);
            } else {
                $dql = $this->em->getRepository("AppBundle:Pedidos")->getListPedidos();
            }
        } else {
            $dql = $this->em->getRepository("AppBundle:Pedidos")->getListPedidos();
        }

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