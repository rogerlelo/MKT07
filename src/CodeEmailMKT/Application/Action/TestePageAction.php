<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
//use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Template\TemplateRendererInterface;
//use Zend\Expressive\Twig\TwigRenderer;
//use Zend\Expressive\ZendView\ZendViewRenderer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class TestePageAction
{
    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository,TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customer = new Customer();
        $customer->setName('Luiz Carlos')
                 ->setEmail('luiz@code.education');

        $this->repository->create($customer);

        $customers = $this->repository->findAll();

        return new HtmlResponse($this->template->render("app::teste",[
            "data"=>'dados passados para o template',
            'customers'=> $customers,
            'minhaClasse' => new \CodeEmailMKT\MinhaClasse()
        ]));

    }
}
