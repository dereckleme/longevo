<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chamados;
use AppBundle\Entity\Clientes;
use AppBundle\Entity\Pedidos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $dataRequest = $request->request->all();
        $em    = $this->get('doctrine.orm.entity_manager');
        $servicePedidos = $this->get('pedidos.service');
        $dql = $servicePedidos->getListaPedidos($dataRequest);
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'list' => $pagination,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/chamado/detalhe/{idPedido}", name="detalhePedido")
     */
    public function detalheChamadoAction($idPedido)
    {
        $chamadoService = $this->get('chamado.service');
        $chamado = $chamadoService->getChamadoByPedido($idPedido);
        $response = new Response();
        $response->setContent(json_encode($chamado));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/chamado/adicionar", name="adicionarChamado")
     * @Method({"GET", "POST"})
     */
    public function adicionarChamadoAction(Request $request)
    {
        $clientesService = $this->get('clientes.service');
        $pedidoService  = $this->get('pedidos.service');
        $chamados = new Chamados();
        $form = $this->createForm('AppBundle\Form\ChamadoType', $chamados);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $request->request->all();
            $this->validateData($data, $form);

            $nome = $data['chamado']['nome'];
            $email = $data['chamado']['email'];
            $pedido = $data['chamado']['numeroPedido'];

            if (!empty($nome) and !empty($email) and !$clientesService->hasClienteByNameAndEmail($nome, $email)) {
                $form->addError(new FormError("Não existe um cliente cadastrado com este nome ou email!"));
            }

            if (!empty($pedido) && is_numeric($pedido) && $pedidoService->hasPedidoById($pedido)) {
                $form->addError(new FormError("Já existe um numero de pedido registrado #{$pedido}, escolha outro."));
            } else if (!is_numeric($pedido) && !empty($pedido)){
                $form->addError(new FormError("Número de chamado inválido!"));
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $cliente = $clientesService->getClienteByNameAndEmail($nome, $email);
            $em      = $this->getDoctrine()->getManager();
            $em->persist($chamados);

            $pedido  = new Pedidos();
            $pedido->setChamado($chamados);
            $pedido->setCliente($cliente);
            $pedido->setId(800);
            $em->persist($pedido);
            $em->flush();

            $response = new Response();
            $response->setContent(json_encode(array("action" => "sucess")));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        return $this->render('default/novoChamado.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function validateData($data, $form)
    {
        foreach ($data['chamado'] as $key => $value) {
            if (empty($value)) {
                $form->addError(new FormError("O campo {$key} não pode está em branco."));
            }
        }
    }
}
