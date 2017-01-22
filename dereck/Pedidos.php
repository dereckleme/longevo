<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @ORM\Table(name="pedidos", indexes={@ORM\Index(name="fk_pedidos_clientes_idx", columns={"cliente"}), @ORM\Index(name="fk_pedidos_chamados1_idx", columns={"chamado"})})
 * @ORM\Entity
 */
class Pedidos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

