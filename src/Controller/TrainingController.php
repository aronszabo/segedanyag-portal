<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class TrainingController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $trainingRepository;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $subjectRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->trainingRepository = $entityManager->getRepository('App:Training');
        $this->subjectRepository = $entityManager->getRepository('App:Subject');
    }
    /**
     * @Route("/training", name="training")
     */
    public function index()
    {
        return $this->render('training/index.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }
    /**
     * @Route("/{trtype}/{slug}", name="training_list", requirements={
     *     "trtype"="bsc|msc|bprof"
     * })
     */
    public function list($trtype, $slug)
    {

        $training = $this->trainingRepository->findOneBySlug($slug);
        $subjects = array(array(),array(),array(),array(),array(),array(),array(),array(),array());
        foreach ($training->getSubjects() as $subject) {
          $subjects[$subject->getSemester()][] = $subject;
        }
        return $this->render('training/index.html.twig', [
            'controller_name' => 'TrainingController',
            'training' => $training,
            'subjects' => $subjects,
            'trainingtype' => $training->getType()
        ]);
    }
    public function menu($trainingtype)
    {
        // make a database call or other logic
        // to get the "$max" most recent articles


        $bsctrainings = $this->trainingRepository->findByBsc(true);
        $msctrainings = $this->trainingRepository->findByMsc(true);
        $bproftrainings = $this->trainingRepository->findByBprof(true);
        return $this->render(
            'training/menu.html.twig',
            array('bsctrainings' => $bsctrainings, 'msctrainings' => $msctrainings, 'bproftrainings' => $bproftrainings, 'trainingtype' => $trainingtype)
        );
    }
}
