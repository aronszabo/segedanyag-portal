<?php

namespace App\Uploader;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MaterialNamer implements NamerInterface
{
    protected $requestStack;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $materialRepository;
    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
        $this->materialRepository = $entityManager->getRepository('App:Material');
    }
    /**
     * Creates a user directory name for the file being uploaded.
     *
     * @param FileInterface $file
     * @return string The directory name.
     */
    public function name(FileInterface $file)
    {
        $request = $this->requestStack->getCurrentRequest();

        $material = $this->materialRepository->findOneById($request->request->get('material'));
        if($material==null || $material->getSubject()==null || $material->getSubject()->getTraining()==null){
            return sprintf('egyeb/%s.%s',
                $request->request->get('cslug'),
                $file->getExtension()
            );
        }else{

            return sprintf('%s/%s/%s/%s.%s',
                $material->getSubject()->getTraining()->getType(),
                $material->getSubject()->getTraining()->getSlug(),
                $material->getSubject()->getSlug(),
                $request->request->get('cslug'),
                $file->getExtension()
            );
        }

    }
}
