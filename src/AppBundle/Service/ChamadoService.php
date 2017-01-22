<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 18:03
 */
class ChamadoService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ChamadoService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getChamadoByPedido($id)
    {
        $pedido = $this->em->getRepository("AppBundle:Pedidos")->find($id);

        if ($pedido) {
            $result = array(
                "id" => $pedido->getChamado()->getId(),
                'titulo' => $pedido->getChamado()->getTitulo(),
                'descricao' => $pedido->getChamado()->getObservacao(),
            );

            return $result;
        } else {
            throw new \Exception("Não foi possível encontrar o chamado solicitado");
        }
    }
}