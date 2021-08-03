<?php

namespace App\Controller;

use App\Entity\Short;
use App\Repository\ShortRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


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
     * @Route("/{id}", name="shortShow", requirements={"id":"\d+"})
     */
    public function show(Short $short): Response
    {
        return $this->json($short);
    }

    /**
     * @Route("/create", name="shortCreate", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $manager, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();

        $short = $serializer->deserialize($data, Short::class, 'json');

        $manager->persist($short);
        $manager->flush();

        return $this->json($short);
    }

    /**
     * @Route("/delete/{id}", name="shortDelete")
     */
    public function delete(Short $short, EntityManagerInterface $manager): Response
    {
        $manager->remove($short);
        $manager->flush();

        return $this->json("REMOVE OK");
    }

}
