<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use App\Service\PHPMailService;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil Controller',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'Page de Contact',
            'coordonnees1' => [
                "Nom" => " Lacroix",
                "Prenom" => " Sylvain",
                "Adresse" => " 27 rue Henri de toulouse Lautrec 81430 Villefranche d'Albigeois",
            ],
            'coordonnees2' => [
                "Nom" => " Dupont",
                "Prenom" => " Jacque",
                "Adresse" => " 27 rue de Parla 81430 Parici",
            ]
        ]);
    }

    #[Route('/mail', name: 'app_mail')]
    public function mail(MailerInterface $mailer): Response
    {
        //envoie du mail
        $email = new Email();
        $email->from('symfony6@gmail.com')
            ->to('sylvainlacroix@protonmail.com')
            ->subject('Test Email symfony')
            ->text('Texte du test Email de symfony')
            ->html('<h2>Test Email</h2>');

        $mailer->send($email);

        return $this->render('home/mail.html.twig', [
            'controller_name' => 'Envoie Réussi',
        ]);
    }

    #[Route('/phpmail', name: 'app_phpmail')]
    public function phpmail(): Response
    {
        //configuration
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'scaleautoperfect@gmail.com';                     //SMTP username
        $mail->Password   = 'hfjjcunhgurckcag';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;

        //envoie du mail
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('sylvainlacroix@protonmail.com', 'Joe User');

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Test PHPMail';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        $mail->send();

        return $this->render('home/mail.html.twig', [
            'controller_name' => 'Envoie Réussi',
        ]);
    }

    #[Route('/service', name: 'app_service')]
    public function service(MessageGenerator $msg): Response
    {

        return $this->render('home/mail.html.twig', [
            'controller_name' => $msg->getHappyMessage(),
        ]);
    }

    #[Route('/phpmailservice', name: 'app_phpmailservice')]
    public function phpmailService(PHPMailService $mail): Response
    {
        //envoie du mail
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('sylvainlacroix@protonmail.com', 'Joe User');

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Test PHPMail';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        $mail->send();

        return $this->render('home/mail.html.twig', [
            'controller_name' => 'Envoie Réussi',
        ]);
    }
}
