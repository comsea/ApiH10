<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_form", methods={"POST"})
     */
    public function handleContactForm(Request $request, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), true);

        // Récupérez les données du formulaire
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $phone = $data['phone'];
        $subject = $data['subject'];
        $messageContent = $data['message'];
        $acceptTerms = $data['acceptTerms'];

        // Exemple d'utilisation des données : envoi d'email avec le composant Mailer de Symfony
        if ($acceptTerms) {
            $email = (new Email())
                ->from($email)
                ->to('t.hemonet@comsea.fr')
                ->subject($subject)
                ->html("<p>Nom: $firstName $lastName</p><p>Email: $email</p><p>Téléphone: $phone</p><p>Sujet: $subject</p><p>Message: $messageContent</p>");

            $mailer->send($email);
            // Ici, vous pouvez effectuer d'autres actions comme enregistrer en base de données
        }

        return new Response('Données reçues avec succès!', Response::HTTP_OK);
    }
}
