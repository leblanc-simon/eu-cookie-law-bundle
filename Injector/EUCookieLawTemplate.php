<?php

/*
 * This file is part of the EUCookieLawBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\EUCookieLawBundle\Injector;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EUCookieLawTemplate
{
    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var string
     */
    private $template_name;

    /**
     * @var string
     */
    private $cookie_name;

    /**
     * @var string
     */
    private $cookie_value;

    /**
     * EUCookieLawTemplate constructor.
     *
     * @param TwigEngine $templating
     * @param $template_name
     * @param $cookie_name
     * @param $cookie_value
     */
    public function __construct(TwigEngine $templating, $template_name, $cookie_name, $cookie_value)
    {
        $this->templating = $templating;
        $this->template_name = $template_name;
        $this->cookie_name = $cookie_name;
        $this->cookie_value = $cookie_value;
    }

    /**
     * Inject in the response the cookie law template
     *
     * @param Response $response
     * @param Request $request
     */
    public function inject(Response $response, Request $request)
    {
        if ($this->checkIfMustBeInjected($response, $request) === false) {
            return;
        }

        $render_template = $this->templating->render($this->template_name, [
            'cookie_name' => $this->cookie_name,
            'cookie_value' => $this->cookie_value,
        ]);

        $content = $response->getContent();
        $position = mb_strripos($content, '</body>');
        if (false !== $position) {
            $content = mb_substr($content, 0, $position).$render_template.mb_substr($content, $position);
            $response->setContent($content);
        }
    }

    /**
     * Check if we must inject the cookie law template
     *
     * @param Response $response
     * @param Request $request
     * @return bool
     */
    private function checkIfMustBeInjected(Response $response, Request $request)
    {
        if (false === strpos($response->headers->get('Content-Type'), 'text/html')) {
            return false;
        }

        if ($this->cookie_value === $request->cookies->get($this->cookie_name)) {
            return false;
        }

        return true;
    }
}
