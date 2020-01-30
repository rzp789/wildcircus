<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Entity\Spectateur;
use App\Form\SpectateurType;
use App\Repository\SpectateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spectateur")
 */
class SpectateurController extends AbstractController
{
    /**
     * @Route("/", name="spectateur_index", methods={"GET"})
     */
    public function index(SpectateurRepository $spectateurRepository): Response
    {
        return $this->render('spectateur/index.html.twig', [
            'spectateurs' => $spectateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="spectateur_new", methods={"GET","POST"})
     */
    public function new(Request $request,Spectacle $spectacle,\Swift_Mailer $mailer): Response
    {
        $spectateur = new Spectateur();

        $form = $this->createForm(SpectateurType::class, $spectateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $spectateur->setSpectacle($spectacle);
            $spectacle->setCountspectateur(($spectacle->getcountspectateur()+1)) ;


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spectateur);
            $entityManager->flush();

            if ($spectacle->getCountspectateur() == $spectacle->getNbspectator()){
                $spectateurs = $this->getDoctrine()
                    ->getRepository(Spectateur::class)
                    ->findBy(['spectacle' => $spectacle
                    ]);
                $mails = [];
                foreach ($spectateurs as $spectateur){
                    $mails[]=$spectateur->getEmail();
                }




                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('adrzp789@gmail.com')
                    ->setTo($mails)
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'emails/registration.html.twig'

                        ),
                        'text/html'
                    )

                ;

                $mailer->send($message);

                //return $this->render(...);

            }

            return $this->redirectToRoute('spectateur_index');
        }


        return $this->render('spectateur/new.html.twig', [
            'spectateur' => $spectateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectateur_show", methods={"GET"})
     */
    public function show(Spectateur $spectateur): Response
    {
        return $this->render('spectateur/show.html.twig', [
            'spectateur' => $spectateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spectateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spectateur $spectateur): Response
    {
        $form = $this->createForm(SpectateurType::class, $spectateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spectateur_index');
        }

        return $this->render('spectateur/edit.html.twig', [
            'spectateur' => $spectateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spectateur $spectateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spectateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spectateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spectateur_index');
    }
}
