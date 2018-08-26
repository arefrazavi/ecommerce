<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        //$admin = $this->getDoctrine()->getRepository(User::class)->find(1);

        //var_dump($admin->getRoles());
        //$roles = $admin->getRoles();

//        foreach ($roles as $userRole) {
//            $role = $userRole->getRole();
//            var_dump($role->getName());
//        }

        $userId = 0;
        $firstName = '';
        $user = $this->getUser();

        if ($user) {
            $userId = $user->getId();
            $firstName = $user->getFirstName();
        }

        return $this->render('main/index.html.twig', compact('userId', 'firstName'));
    }
}
