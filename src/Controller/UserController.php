<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; // @dth: to encode the pass

#[Route('/user')]
class UserController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
       $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new')]
    public function new(Request $request,ManagerRegistry $doctrine)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $em= $doctrine->getManager();
            $em->persist($user);
            $em->flush();
             // @todo: refactor
        $plainpwd = $user->getPassword();
        $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
        $user->setPassword($encoded);
       //  $user->setCreationDate(new \DateTime());            



       // @todo: refactor
       $entityManager = $this->getDoctrine()->getManager();
       $plainpwd = $user->getPassword();
       $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
       $user->setPassword($encoded);
       $entityManager->persist($user);
        $entityManager->flush();
            return $this->redirectToRoute('app_user_index');
        }
        
        

        return $this->renderForm('user/new.html.twig', array(
    'userForm' => $form)
);
        
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);

        // @todo: refactor
        $plainpwd = $user->getPassword();
        $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
        $user->setPassword($encoded);
        #$user->setCreationDate(new \DateTime());            



       // @todo: refactor
       $entityManager = $this->getDoctrine()->getManager();
       $plainpwd = $user->getPassword();
       $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
       $user->setPassword($encoded);
       $entityManager->persist($user);
        $entityManager->flush();
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

   
}