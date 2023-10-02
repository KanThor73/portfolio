<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/', name: 'home')]
    public function index(Request $request, MailerInterface $mailer, Filesystem $filesystem): Response
    {
        $contactForm = $this->createForm(ContactType::class)->handleRequest($request);
//        $this->$filesystem->mkdir('')

        if ($contactForm->isSubmitted() && $contactForm->isSubmitted()) {

            $emailContact = $contactForm->get('email')->getData();
            $firstname = $contactForm->get('firstname')->getData();
            $name = $contactForm->get('name')->getData();
            $object = $contactForm->get('object')->getData();
            $message = $contactForm->get('message')->getData();
            $telephone = $contactForm->get('telephone')->getData();
            if ($telephone === null) {
                $telephone = 'Pas de telephone renseigne';
            };

            $email = new TemplatedEmail();
            $email
                ->to('tjacquet53@gmail.com')
                ->from('contact@tjacquet-portfolio.fr')
                ->subject($object)
                ->htmlTemplate('emails/emailContact.html.twig')
                ->context([
                    'name' => $name,
                    'firstname' => $firstname,
                    'telephone' => $telephone,
                    'message' => $message,
                    'emailContact' => $emailContact,
                    'date' => new \DateTime('now')
                ]);

            $mailer->send($email);

            $this->addFlash('message', 'merci pour votre message, je vous reponds au plus vite !');
        }

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $contactForm
        ]);
    }
}
