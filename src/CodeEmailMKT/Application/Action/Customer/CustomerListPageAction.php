<?php

namespace CodeEmailMKT\Application\Action\Customer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerListPageAction
{
    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(
        CustomerRepositoryInterface $repository,
        TemplateRendererInterface $template)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customers = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        return new HtmlResponse($this->template->render("app::customer/list",[
            'customers'=> $customers,
            'message'=> $flash->getMessage('success')
        ]));

    }
}
