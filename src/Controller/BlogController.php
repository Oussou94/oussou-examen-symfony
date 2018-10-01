<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     *  @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */

    public function createArticle(Request $request,ObjectManager $manager)
    {
        $article= new Article();

        $form =$this->createFormBuilder($article)
                    ->add('titre', TextType::class,[
                        'attr' => [

                        'placeholder' =>"Titre de l article",
                            'class'=>"col-3"

                            ]


                    ])
                     ->add('contenu',TextareaType::class,[
                         'attr' => [

                         'placeholder' =>"Contenu de l article",
                          'class'=>"col-3"
                             ]

                     ])
                     ->add('image',FileType::class,[
                         'attr' => [

                         'placeholder' =>"mettre une image",
                             'class'=>"col-2"
                         ]

                     ])


                      ->getForm();
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){
            $article->setDateCreation(new \DateTime());

            $manager->persist($article);
            $manager->flush();

            return  $this->redirectToRoute('blog');

        }


        return $this->render('blog/create.html.twig',[
            'formarticle' => $form->createView()
        ]);

    }
}
