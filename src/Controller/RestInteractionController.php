<?php

namespace App\Controller;

use App\Service\RestConsumeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestInteractionController extends AbstractController
{
    /**
     * @Route("/rest/interaction", name="rest_interaction")
     */

    public function index(Request $request, RestConsumeService $restConsumeService)
    {
        $api_data = $restConsumeService->getInteractioResponseData($request);

        return $this->render('rest_interaction/index.html.twig', [
            'api_data' => $api_data,
        ]);
    }
}
