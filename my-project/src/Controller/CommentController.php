<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index()
    {
        $comment = $this -> getDoctrine()
        ->getRepository("App:Comment")
        ->findAll();
        return $this->render('comment/index.html.twig', [
        'Comment' => $comment,
        ]);
    }
}
