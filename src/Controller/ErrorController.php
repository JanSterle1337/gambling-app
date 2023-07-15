<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use League\Plates\Engine as TemplateEngine;

class ErrorController
{
    public TemplateEngine $templates;

    public function __construct(TemplateEngine $templates)
    {
        $this->templates = $templates;
    }

    public function show404(): Response
    {
        return new Response(
            $this->templates->render('error/404'),
            Response::HTTP_NOT_FOUND
        );
    }
}

