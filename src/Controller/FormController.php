<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FormController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/form', name: 'app_form')]
    public function index(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if ($data != null) {

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

                $this->mailer->send($email);
                // Ici, vous pouvez effectuer d'autres actions comme enregistrer en base de données
            }
        }
        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    #[Route('/formCandidat', name: 'app_formCandidat')]
    public function handleContact(Request $request): Response
    {
        $formData = $request->request->all();
        $file = $request->files->get('file');

        if ($formData !== null && $file !== null) {
            $firstName = $formData['firstName'];
            $lastName = $formData['lastName'];
            $email = $formData['email'];
            $phone = $formData['phone'];
            $subject = $formData['subject'];
            $message = $formData['message'];
            $acceptTerms = $formData['acceptTerms'];

            if ($acceptTerms) {
                // Envoyer l'email avec le fichier PDF en pièce jointe
                $email = (new Email())
                    ->from($email)
                    ->to('t.hemonet@comsea.fr')
                    ->subject($subject)
                    ->html("<p>Nom: $firstName $lastName</p><p>Email: $email</p><p>Téléphone: $phone</p><p>Sujet: $subject</p><p>Message: $message</p>");

                $email->attachFromPath($file->getPathname(), 'Cv' . $firstName . $lastName . '.pdf');

                $this->mailer->send($email);

                // Ici, vous pouvez ajouter d'autres actions comme l'enregistrement en base de données
            }
        }
        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }
}
