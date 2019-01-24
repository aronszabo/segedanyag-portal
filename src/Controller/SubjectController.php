<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SubjectController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $materialRepository;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $subjectRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->materialRepository = $entityManager->getRepository('App:Material');
        $this->subjectRepository = $entityManager->getRepository('App:Subject');
    }
    /**
     * @Route("/subject", name="subject")
     */
    public function index()
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }
    /**
     * @Route("/{trtype}/{trslug}/{slug}", name="subject_list", requirements={
     *     "trtype"="bsc|msc|bprof"
     * })
     */
    public function list($trtype,$trslug,$slug)
    {

        //$subject = $this->subjectRepository->findOneBySlug($slug);
        $subject =  $this->subjectRepository->findOneBySlugs($trtype, $trslug, $slug);
        if ($subject==null) throw $this->createNotFoundException('Subject does not exist');
        $materials = array();
        foreach ($subject->getMaterials() as $material) {
          $materials[$material->getType()->getName()][] = $material;
        }

        return $this->render('subject/index.html.twig', [
            'subject' => $subject,
            'materials' => $materials,
            'trainingtype' => $subject->getTraining()->getType()
        ]);
    }
}
