<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/subject/{id}/comment', name: 'show_comments', methods: ['GET'])]
    public function readAll(int $id): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
    #[Route('/subject/{id}/comment/new', name: 'new_comment', methods: ['GET', 'POST'])]
    public function create(int $id): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
    #[Route('/subject/{id}/comment/{commentId}', name: 'show_comment', methods: ['GET'])]
    public function read(int $id, int $commentId): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
    
    #[Route('/subject/{id}/comment/{commentId}/edit', name: 'edit_comment', methods: ['GET', 'PUT'])]
    public function update(int $id, int $commentId): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
    #[Route('/subject/{id}/comment/{commentId}/delete', name: 'delete_comment', methods: ['GET', 'DELETE'])]
    public function delete(int $id, int $commentId): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
}
