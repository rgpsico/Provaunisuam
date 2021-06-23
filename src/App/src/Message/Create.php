<?php

declare(strict_types=1);

namespace App\Message;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;



class Create  implements RequestHandlerInterface
{
     
    private $tableGateway;
  
   
      public function __construct($tableGateway)
      {
         
          $this->tableGateway = $tableGateway;
      }
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {           
       $data   =  $request->getParsedBody(); 
       $data['status_id'] = 3;

       if(!$this->EmailValidation($data['email'])){
        $array = ["Sucesse"=>false,"content"=> "E-mail é invalido"];
          return  new JsonResponse($array,403);
       }

       if(!$this->CpfValidation($data['cpf'])){
        $array = ["Sucesse"=>false,"content"=> "Cpf inválido formato deve ser 111.111.111-11"];
        return  new JsonResponse($array,403);
        exit;
        }

       
 
       $rowset = $this->tableGateway->select(array('cpf' => $data['cpf']));

       if (count($rowset) === 0) {
           $insert =  $this->tableGateway->insert($data);
           $array = ["Sucesse"=>"true","content"=> "Cadastrado com sucesso cadastrado"];
            } else {
        $array = ["Sucesse"=>"true","content"=> "CPF ja foi cadastrado"];
       }

       return  new JsonResponse($array,403);
    
    }
    
    public function EmailValidation($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
      

    }

    public function CpfValidation($cpf) {
      
 
            // Extrai somente os números
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
             
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {
                return false;
            }
        
            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }
        
            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;

    }

    
    
}
