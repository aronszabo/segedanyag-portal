<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MaterialController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $materialRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->materialRepository = $entityManager->getRepository('App:Material');
    }
    /**
     * @Route("/{trtype}/{trslug}/{sslug}/{slug}", name="material_show")
     */
    public function show($trtype,$trslug,$sslug,$slug)
    {
      $material = $this->materialRepository->findOneBySlug($slug);

      return $this->render('material/index.html.twig', [
          'material' => $material,
          'trainingtype' => $material->getSubject()->getTraining()->getType()
      ]);
    }
}
