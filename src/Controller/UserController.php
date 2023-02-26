<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    private $disptacher;
    public function __construct(EventDispatcherInterface $disptacher) {
        $this->disptacher = $disptacher;
    }

    #[Route('/register/{username}', name: 'app_user')]
    public function index($username): Response
    {

        $user = new User();
        $user->setUsername("Zadi");

        // create mon event
        $event = new UserRegisteredEvent($user);

        // propagation de l'event
        $this->disptacher->dispatch($event, UserRegisteredEvent::NAME);

        return $this->render('register/index.html.twig', [
            'username' => $username,
        ]);

    }
}
