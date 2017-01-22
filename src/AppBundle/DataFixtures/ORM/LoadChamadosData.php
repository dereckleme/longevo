<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Chamados;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * Created by PhpStorm.
 * User: dereck
 * Date: 21/01/2017
 * Time: 16:56
 */
class LoadChamadosData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $chamadoData = array(
            array("titulo" => "chamado titulo teste1", "descricao" => "teste1", "ref" => "felipe"),
            array("titulo" => "chamado titulo teste2", "descricao" => "teste2", "ref" => "joao"),
            array("titulo" => "chamado titulo teste3", "descricao" => "teste3", "ref" => "maria"),
            array("titulo" => "chamado titulo teste4", "descricao" => "teste4", "ref" => "teste"),
            array("titulo" => "chamado titulo teste5", "descricao" => "teste5", "ref" => "dereck"),
            array("titulo" => "chamado titulo teste6", "descricao" => "teste6", "ref" => "natalia"),
            array("titulo" => "chamado titulo teste7", "descricao" => "teste7", "ref" => "maynara"),
            array("titulo" => "chamado titulo teste8", "descricao" => "teste8", "ref" => "fernando"),
            array("titulo" => "chamado titulo teste9", "descricao" => "teste9", "ref" => "franz"),
            array("titulo" => "chamado titulo teste10", "descricao" => "teste10", "ref" => "lucio")
        );

        foreach ($chamadoData as $chamadoValue) {
            $chamado = new Chamados();
            $chamado->setObservacao($chamadoValue['descricao']);
            $chamado->setTitulo($chamadoValue['titulo']);
            $manager->persist($chamado);
            $this->addReference("chamado-{$chamadoValue['ref']}", $chamado);
        }
        $manager->flush();
    }
}