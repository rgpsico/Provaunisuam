<?php

namespace App\Message;


use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateWay\TableGateWay;
use Zend\Http\Request;
class Factory 
{
    public function __invoke(ContainerInterface $container , $requestedName)
    {
        	

        $config       = $container->get('config');
        $adapter      = new Adapter($config['db']);
        $tableGateway = new TableGateway('indicacoes',$adapter);
         
        
        return new $requestedName($tableGateway);
        

        
    }

}



?>