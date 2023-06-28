<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/register', name: 'new_user', methods: ['GET', 'POST'])]
    public function create(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/login', name: 'login_user', methods: ['GET', 'POST'])]
    public function connect(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/logout', name: 'logout_user', methods: ['GET', 'POST'])]
    public function disconnect(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user', name: 'show_users', methods: ['GET'])]
    public function readAll(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/active', name: 'show_active_users', methods: ['GET'])]
    public function readAllActive(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/inactive', name: 'show_inactive_users', methods: ['GET'])]
    public function readAllInactive(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/{username}', name: 'show_user_profile', methods: ['GET'])]
    public function read(string $username): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/{username}/edit', name: 'edit_user_profile', methods: ['GET', 'PUT'])]
    public function update(string $username): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/{username}/delete', name: 'delete_user_profile', methods: ['GET', 'DELETE'])]
    public function delete(string $username): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
