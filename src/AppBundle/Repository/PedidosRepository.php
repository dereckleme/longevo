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

    /**
     * @param $email
     * @return string
     */
    public function getListPedidosByEmail($email)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->join('p.cliente', 'c');
        $qb->where($qb->expr()->like('c.email', $qb->expr()->literal("%{$email}%")));
        $dql = $qb->getDQL();
        return $dql;
    }

    /**
     * @param $id
     * @return string
     */
    public function getListPedidosById($id)
    {
        $dql = $this->createQueryBuilder('p')
                    ->where("p.id = '{$id}'")
                    ->getDQL();

        return $dql;
    }
}