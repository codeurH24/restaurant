<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoomServiceController extends AbstractController
{
    /**
     * @Route("/room-service", name="room_service", methods={"GET"})
     */
    public function index()
    {
        return $this->render('room_service/index.html.twig');
    }

}
