<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class SubjectController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/subject', name: 'show_subjects', methods: ['GET'])]
    public function readAll(): Response
    {
        $subjectRepository = $this->doctrine->getRepository(Subject::class);
        $subjects = $subjectRepository->findAll();

        return $this->render('subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }
    #[Route('/subject/new', name: 'new_subject', methods: ['GET', 'POST'])]
    public function create(): Response
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }
    #[Route('/subject/{id}', name: 'show_subject', methods: ['GET'])]
    public function read(int $id): Response
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }
    #[Route('/subject/{id}/edit', name: 'edit_subject', methods: ['GET', 'PUT'])]
    public function update(int $id): Response
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }
    #[Route('/subject/{id}/delete', name: 'delete_subject', methods: ['GET', 'DELETE'])]
    public function delete(int $id): Response
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }
}
