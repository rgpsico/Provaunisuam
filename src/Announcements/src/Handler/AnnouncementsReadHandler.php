<?php

declare(strict_types=1);

namespace Announcements\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
class AnnouncementsReadHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = ['message'=>'roger'];

        return  new JsonResponse($data,200);
    }
}
