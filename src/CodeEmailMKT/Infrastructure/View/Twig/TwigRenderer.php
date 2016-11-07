<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @see       https://github.com/zendframework/zend-expressive for the canonical source repository
 * @copyright Copyright (c) 2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive/blob/master/LICENSE.md New BSD License
 */

namespace CodeEmailMKT\Infrastructure\View\Twig;

use Twig_Environment as TwigEnvironment;
use Zend\Expressive\Twig\TwigRenderer as ZendTwigRenderer;

class TwigRenderer extends ZendTwigRenderer
{
    /**
     * @return TwigEnvironment
     */
    public function getTemplate(): TwigEnvironment
    {
        return $this->template;
    }

}
