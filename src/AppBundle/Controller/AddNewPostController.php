<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use AppBundle\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddNewPostController extends Controller
{
    /**
     * @param Request $request
     * @Route("/add-new-post", name="add_new_post")
     * @return RedirectResponse|Response
     */
    private function addNewPostAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostFormType::class, $post);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@App/add-new-question.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}