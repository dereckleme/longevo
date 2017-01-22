<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Chamados
 *
 * @ORM\Table(name="chamados")
 * @ORM\Entity
 */
class Chamados
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
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=255, nullable=true)
     */
    private $observacao;


}

