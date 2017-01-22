<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Pedidos;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 16:56
 */
class LoadPedidosData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $clientesData = array(
            "felipe",
            "joao",
            "maria",
            "teste",
            "dereck",
            "natalia",
            "maynara",
            "fernando",
            "franz",
            "lucio"
        );

        foreach ($clientesData as $nome) {
            $pedido = new Pedidos();
            $pedido->setChamado($this->getReference("chamado-{$nome}"));
            $pedido->setCliente($this->getReference("cliente-{$nome}"));
            $manager->persist($pedido);
        }

        $manager->flush();
    }
}