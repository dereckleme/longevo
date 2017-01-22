<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @ORM\Table(name="pedidos", indexes={@ORM\Index(name="fk_pedidos_clientes_idx", columns={"cliente"}), @ORM\Index(name="fk_pedidos_chamados1_idx", columns={"chamado"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidosRepository")
 */
class Pedidos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Chamados
     *
     * @ORM\ManyToOne(targetEntity="Chamados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chamado", referencedColumnName="id")
     * })
     */
    private $chamado;

    /**
     * @var \Clientes
     *
     * @ORM\ManyToOne(targetEntity="Clientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Chamados
     */
    public function getChamado()
    {
        return $this->chamado;
    }

    /**
     * @param \Chamados $chamado
     */
    public function setChamado($chamado)
    {
        $this->chamado = $chamado;
    }

    /**
     * @return \Clientes
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param \Clientes $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }
}

