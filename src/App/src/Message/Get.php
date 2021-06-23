<?php

declare(strict_types=1);

namespace App\Message;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Router;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class Get implements RequestHandlerInterface
{
     
    private $tableGateway;

  
      public function __construct($tableGateway)
      {
          $this->tableGateway = $tableGateway;
      }
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {    
        
              $content = $this->tableGateway->select()->toArray();
              return new JsonResponse($content);
    
    }
}
