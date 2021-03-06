<?php


namespace App\Controller;


use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) : Response
    {
        // 1) build the form
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($client, $client->getPassword());
            $client->setPassword($password);

            $client->setRoles(['USER']);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }


}