<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
//use Symfony\Component\Routing\RouterInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use CodeEmailMKT\Application\Form\HttpMethodElement;

class CustomerUpdatePageAction
{
    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(CustomerRepositoryInterface $repository,
                                TemplateRendererInterface $template,
                                RouterInterface $router)
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        $myform = new Form();
        $myform->add(new HttpMethodElement('PUT'));
        $myform->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Name:'
            ]
        ]);
        $myform->add([
            'name' => 'email',
            'type' => 'Text',
            'options' => [
                'label' => 'E-mail:'
            ]
        ]);

        $myform->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Submit',
            ],
            'options' => [
                'label' => 'Submit'
            ]
        ]);

        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        //$form = new CustomerForm

        $myform->setHydrator(new ClassMethods()); //atribuir o hidrator /////////////
        $myform->bind($entity); //liga a entidade ao formulário ////////////////

        if($request->getMethod() == 'PUT'){
            $flash = $request->getAttribute('flash');

            $data = $request->getParsedBody();
            $entity
                ->setName($data['name'])
                ->setEmail($data['email']);
            $this->repository->update($entity);
            $flash->setMessage('success','Contato editado com sucesso');
            $uri = $this->router->generateUri('customer.list');
            return new RedirectResponse($uri);
        }
        return new HtmlResponse($this->template->render("app::customer/update",[
            'customer' => $entity,
            'form' => $myform
        ]));

    }
}
