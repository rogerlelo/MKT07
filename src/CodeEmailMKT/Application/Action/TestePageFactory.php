<?php

namespace CodeEmailMKT\Application\Action;

//use CodeEmailMKT\Application\Action\TestePageAction;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class TestePageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;
                                         //'Doctrine\ORM\EntityManager' //apartir php 5.5
        return new TestePageAction($container->get(CustomerRepositoryInterface::class),$template);
    }
}
