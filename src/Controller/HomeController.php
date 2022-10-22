<?php

namespace App\Controller;

use App\Generator\YamlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    public function __construct (
        private readonly YamlGenerator $yamlGenerator
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $emptyParams = new FormParams();
        $params = [0 => $emptyParams];
        $dockerComposeContent = null;

        if ($request->getMethod() === 'POST') {
            $params = $this->generateFormParam($request->request);
            $dockerComposeContent = $this->yamlGenerator->generate($params);
        }

        return $this->render('home/index.html.twig', [
            'emptyParams' => $emptyParams,
            'params' => $params,
            'lastIndex' => count($params) - 1,
            'yamlContent' => $dockerComposeContent,
        ]);
    }

    /**
     * @return array<int, FormParams>
     */
    private function generateFormParam(InputBag $inputs): array
    {
        $formParamsList = [];

        for ($i=0; $i<INF; $i++) {
            if (!$inputs->has("build_{$i}_image")) {
                break;
            }

            $formParams = new FormParams();
            $formParams->name = $inputs->get("build_{$i}_name");
            $formParams->image = $inputs->get("build_{$i}_image");
            $formParamsList[$i] = $formParams;
        }

        return $formParamsList;
    }
}
