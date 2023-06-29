<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}
    
    #[Route('/subject/{id}/comment', name: 'show_comments', methods: ['GET'])]
    public function readAll(int $id): Response
    {
        $subject = $this->doctrine->getRepository(Subject::class)->find($id);
        
        if (!$subject) {
            return $this->redirectToRoute('show_subjects');
        }
        
        $comments = $subject->getComments();
        
        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
            'subject' => $subject,
        ]);
    }
    #[Route('/subject/{id}/comment/new', name: 'new_comment', methods: ['GET', 'POST'])]
    public function create(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = $this->doctrine->getRepository(Subject::class)->find($id);
        
        if (!$subject) {
            return $this->redirectToRoute('show_subjects');
        }
        
        $comment = new Comment();
        $comment->setSubject($subject);
        
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
            
            return $this->redirectToRoute('show_comments', ['id' => $id]);
        }
        
        return $this->render('comment/form.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }
    #[Route('/subject/{id}/comment/{commentId}', name: 'show_comment', methods: ['GET'])]
    public function read(int $id, int $commentId): Response
    {
        $comment = $this->doctrine->getRepository(Comment::class)->find($commentId);
        
        if (!$comment || $comment->getSubject()->getId() !== $id) {
            return $this->redirectToRoute('show_comments', ['id' => $id]);
        }
        
        return $this->render('comment/index.html.twig', [
            'comments' => [$comment],
        ]);
    }
    
    #[Route('/subject/{id}/comment/{commentId}/edit', name: 'edit_comment', methods: ['GET', 'POST', 'PUT'])]
    public function update(int $id, int $commentId, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = $this->doctrine->getRepository(Comment::class)->find($commentId);
        
        if (!$comment || $comment->getSubject()->getId() !== $id) {
            return $this->redirectToRoute('show_comments', ['id' => $id]);
        }
        
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            
            return $this->redirectToRoute('show_comments', ['id' => $id]);
        }
        
        return $this->render('comment/form.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }
    #[Route('/subject/{id}/comment/{commentId}/delete', name: 'delete_comment', methods: ['GET', 'DELETE'])]
    public function delete(int $id, int $commentId, EntityManagerInterface $entityManager): Response
    {
        $comment = $this->doctrine->getRepository(Comment::class)->find($commentId);
        
        if (!$comment || $comment->getSubject()->getId() !== $id) {
            return $this->redirectToRoute('show_comments', ['id' => $id]);
        }
        
        $entityManager->remove($comment);
        $entityManager->flush();
        
        return $this->redirectToRoute('show_comments', ['id' => $id]);
    }
}
