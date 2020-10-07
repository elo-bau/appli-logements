<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Logement;
use App\Form\LogementCreateType;
use App\Models\Forms\LogementCreateForm;
use App\Models\LogementDTO;
use App\Repository\LogementRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use PhpParser\Node\Expr\Array_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class LogementController
 * @package App\Controller
 * @Route(path="/api/logement")
 */

class LogementController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/", name="api_logement_readAll")
     * @Rest\View()
     * @param LogementRepository $repository
     */
    public function readAll(LogementRepository $repository)
    {
        return $this->view(["logements" => $repository->findAll()],200);
    }

     /**
     * @Rest\Get(path="/{id}", name="api_logement_readOneById")
     * @Rest\View()
     * @param int $id
     * @param LogementRepository $repository
     * @return LogementDTO|View
     */

    public function readOne(int $id, LogementRepository $repository){
        return $this->view(["logement" => $repository->find($id)],200);
    }

    /**
     * @Rest\Post(path="/", name="api_logement_create")
     * @Rest\View()
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return View
     */
    public function create(Request $request, EntityManagerInterface $em) {
        $create = new LogementCreateForm();
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(LogementCreateType::class, $create);
        $form->submit($data);

        if ($form->isValid()) {
            $em->persist(LogementCreateForm::toLogement($create));
            $em->flush();
            return $this->view($create, Response::HTTP_CREATED);
        }

        return $this->view($form->getErrors(), Response::HTTP_PRECONDITION_FAILED);
    }

    /**
     * @Rest\Delete(path="/{id}", name="api_logement_deleteOneById")
     * @Rest\View()
     * @param int $id
     * @param EntityManagerInterface $em
     * @param LogementRepository $repository
     * @return View
     */
    public function delete(EntityManagerInterface $em,int $id,LogementRepository $repository){
        $logement = $repository->find($id);
        $em->remove($logement);
        return $this->view($em->flush(),Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\Post(path="/{id}/update", name="api_logement_updateOneById")
     * @Rest\View()
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param LogementRepository $repository
     * @return View
     */
    public function update(int $id, Request $request, EntityManagerInterface $em, LogementRepository $repository) {
        $create = new LogementCreateForm();
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(LogementCreateType::class, $create);
        $form->submit($data);

        if ($form->isValid()) {
            $logement = $repository->find($id);
            $newLogement = LogementCreateForm::toLogement($create);
            $logement->setName($newLogement->getName());
            $logement->setPrice($newLogement->getPrice());
            $em->persist($logement);
            $em->flush();
            return $this->view($create, Response::HTTP_CREATED);
        }

        return $this->view($form->getErrors(), Response::HTTP_PRECONDITION_FAILED);
    }
}
