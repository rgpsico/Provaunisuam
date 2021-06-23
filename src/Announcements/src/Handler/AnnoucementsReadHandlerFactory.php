<?php


namespace Announcements\Handler;

use Psr\Container\ContainerInterface;


class AnnouncementsReadHandlerFactory 
{
    public function __invoke(ContainerInterface $container) : AnnouncementsReadHandler
    {
       return new AnnouncementsReadHandler();
    }
}
