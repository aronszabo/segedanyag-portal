<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $textContentRepository;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $materialRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */

    private function getContent($identifier){
        $textcontent = $this->textContentRepository->findOneByIdentifier($identifier);
        if($textcontent==null){
          return '<span style="color:red;font-weight:bold">Hianyzo tartalom: <pre>'.$identifier.'</pre></span>';
        }else{
          return $textcontent->getContent();
        }

    }
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->textContentRepository = $entityManager->getRepository('App:TextContent');
        $this->materialRepository = $entityManager->getRepository('App:Material');
    }
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'maincontent' => $this->getContent('fooldal'),
            'sidebar' => $this->getContent('fooldal-oldalsav'),
            'showcase' => $this->materialRepository->findLastEntries(3)
        ]);
    }
    /**
     * @Route("/kapcsolat", name="contact")
     */
    public function contact()
    {
        return $this->render('default/contact.html.twig', [
            'textcontent' => $this->getContent('kapcsolat'),
        ]);
    }
}
