<?php

namespace App\Controller;

use League\Plates\Engine as TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DhiLotoController
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
                'dhi-loto',
                [
                    'success' => true
                ]
            )
        );
    }
}