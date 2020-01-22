<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\TaskList;

use App\Repository\TaskListRepository;
use Doctrine\Common\Persistence\ObjectManager;

class TaskController extends AbstractController
{
    

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('task/home.html.twig');
    }



    /**
     * @Route("/task/create", name="createTask")
     * @Route("/task/{id}/edit", name="editTask")
     */

    public function form(Request $request, TaskList $task = null)
    {
        if(!$task)
        {
            $task = new TaskList();
        }
        
       $task->setTitle("Titre de la tâche");
       $task->setContent("Contenu de la tâche");
       $task->setStatus(null);
        
       $form = $this->createFormBuilder($task)
                ->add('title')
                ->add('content')
                ->add('state', ChoiceType::class, [
                    'choices'  => [
                        'À faire' => 0,
                        'En cours' => 1,
                        'Terminée' => 2
                    ],
                    'label' => 'Current Status',
                    'required' => true,
                ])
                
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $task->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();


            return $this->redirectToRoute('task', ['id' => $task->getId()]);
        }
        
        return $this->render('task/createTask.html.twig', [
            'formTask' => $form->createView(),
            'editMode' => $task->getId() !== null
        ]);

    }

    /**
     * @Route("/task/{id}/delete", name="deleteTask")
     */
    public function deleteTask(TaskList $task, $id) 
    {
        $task = $this->getDoctrine()->getRepository(TaskList::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('task');
    }


    /**
     * @Route("/task", name="task")
     */
    public function index(TaskListRepository $repo)
    {
        $taskList = $repo->findAll();

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'taskList' => $taskList
        ]);
    }

    /**
     * @Route("/task/{id}", name="taskShow")
     */
    public function show(TaskList $task)
    {

        return $this->render('task/show.html.twig', ['task' => $task]);

    }


}
