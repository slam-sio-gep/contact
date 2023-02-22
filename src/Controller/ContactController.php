<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/contacts', name: 'app_contacts', methods: ["GET"])]
    public function listeContacts(): Response
    {
        $contacts = $this->entityManager->getRepository(Contact::class)->findAll();
        return $this->render('contact/listeContacts.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    #[Route('/contact/{id}', name: 'app_contact', methods: ["GET"])]
    public function ficheContact(Contact $contact): Response
    {
        return $this->render('contact/ficheContact.html.twig', [
            'contact' => $contact,
        ]);
    }
}
