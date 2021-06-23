<?php 

namespace Announcements;

use Announcements\Handler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class RoutesDelegator
{
  public function __invoke(Containerinterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->get('/v1/teste',  Handler\AnnouncementsReadHandler::class, 'annoucements.read');

    return $app;

  }  
    
}