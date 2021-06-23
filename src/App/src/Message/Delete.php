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

class Delete implements RequestHandlerInterface
{
     
    private $tableGateway;

  
      public function __construct($tableGateway)
      {
          $this->tableGateway = $tableGateway;
      }
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {    
       
             $id = (int) $request->getAttribute('id');       
        
             $rowset = $this->tableGateway->select(array('id' => $id));
             if(count($rowset) > 0){    
                $delete  = $this->tableGateway->delete(array('id' => $id));
                $result =   new JsonResponse( ["Sucesse"=>"true","content"=>
                                          "Deletado com sucesso"],201);
            }else {
                $result =   new JsonResponse( ["false"=>"true","content"=>
                "Não foi encontrado "],201);
            }

         return $result;
        }
    }


