<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PedidosRepository extends EntityRepository
{
    public function getListPedidos()
    {
        return $this->createQueryBuilder('p')
                    ->getDQL();
    }
}