<?php

namespace App\Controller;

use App\Entity\Short;
use App\Repository\ShortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/short")
 */
class ShortController extends AbstractController
{
    /**
     * @Route("s", name="shortIndex")
     */
    public function index(ShortRepository $shortRepository): Response
    {
        $shorts = $shortRepository->findAll();

        return $this->json($shorts);
    }

    /**
     * @Route("/{id}", name="shortShow")
     */
    public function show(Short $short): Response
    {
        return $this->json($short);
    }
}
