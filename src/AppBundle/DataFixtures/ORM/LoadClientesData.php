<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Clientes;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 16:56
 */
class LoadClientesData extends AbstractFixture implements FixtureInterface
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
            $cliente = new Clientes();
            $cliente->setNome($nome);
            $cliente->setEmail("{$nome}@gmail.com");
            $manager->persist($cliente);
            $this->addReference("cliente-{$nome}", $cliente);
        }

        $manager->flush();
    }
}