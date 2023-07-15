<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use League\Plates\Engine as TemplateEngine;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController
{
    protected TemplateEngine $templates;

    public function __construct(TemplateEngine $templates, Session $session)
    {
        $this->templates = $templates;
        $this->session = $session;
    }

    public function showAction(): Response
    {
        return new Response(
            $this->templates->render(
                'home',
                [
                    'session' => $this->session
                ]
            )
        );
    }
}
