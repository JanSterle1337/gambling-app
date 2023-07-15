<?php

namespace App\Controller;

use League\Plates\Engine as TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GamesController
{
    public TemplateEngine $templates;

    public function __construct(TemplateEngine $templates)
    {
        $this->templates = $templates;
    }

    public function showAction(Request $request): Response
    {
        return new Response(
            $this->templates->render(
                'games',
                [
                    'success' => true
                ]
            )
        );
    }

    public function processAction(Request $request): Response
    {
        return new Response("New yay response");
    }
}