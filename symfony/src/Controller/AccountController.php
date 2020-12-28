<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\Model\Registration;
use App\Form\RegistrationType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(DocumentManager $documentManager, Request $request): Response
    {
        $form = $this->createForm(RegistrationType::class, new Registration());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();

            $documentManager->persist($registration->getUser());
            $documentManager->flush();
            die('User created: ' . $registration->getUser()->getEmail());
            #return $this->redirect(...);
        }

        return $this->render('account/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}