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

class Update implements RequestHandlerInterface
{
     
    private $tableGateway;

  
      public function __construct($tableGateway)
      {
          $this->tableGateway = $tableGateway;
      }
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {    
        $data   = $request->getParsedBody(); 
        
        $id     = (int) $request->getAttribute('id');   
        $rowset = $this->tableGateway->select(array('id' => $id));            
        
        if (count($rowset) == 1) 
        {
            $update =   $this->tableGateway->update($data, array('id' => $id));                  
              if ($update) {
                  $array = ["Sucesse"=>"true","content"=>
                "Atualizado com sucesso com sucesso"];
                    } else {
                        $array = ["Sucesse"=>"true","content"=>
                        "Não foi Atualizado"];
                }
        } else {
             $array = ["Sucesse"=>"true","content"=>
            "Esse ID não existe"];
        }

        return  new JsonResponse($array,201);
    
    }
}
