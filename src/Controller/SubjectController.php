<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Entity\User;
use App\Form\SubjectType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

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
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $subject->setUser($user);

            $entityManager->persist($subject);
            $entityManager->flush();

            return $this->redirectToRoute('show_subjects');
        }
        return $this->render('subject/form.html.twig', [
            'subjectForm' => $form->createView(),
        ]);
    }
    #[Route('/subject/{id}', name: 'show_subject', methods: ['GET'])]
    public function read(int $id, EntityManagerInterface $entityManager): Response
    {
        $subjectRepository = $entityManager->getRepository(Subject::class);
        $subject = $subjectRepository->find($id);
        
        if (is_null($subject)) {
            return $this->redirectToRoute('show_subjects');
        }
    
        return $this->render('subject/index.html.twig', [
            'subjects' => $subject,
        ]);
    }
    #[Route('/subject/{id}/edit', name: 'edit_subject', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = $entityManager->getRepository(Subject::class)->find($id);

        if (!$subject || $subject->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('show_subjects');
        }

        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('show_subjects');
        }
        
        return $this->render('subject/form.html.twig', [
            'subjectForm' => $form->createView(),
        ]);
    }
    #[Route('/subject/{id}/delete', name: 'delete_subject', methods: ['GET', 'DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $subject = $entityManager->getRepository(Subject::class)->find($id);

        if (!$subject || $subject->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('show_subjects');
        }
    
        $entityManager->remove($subject);
        $entityManager->flush();
    
        return $this->redirectToRoute('show_subjects');
    }
}
