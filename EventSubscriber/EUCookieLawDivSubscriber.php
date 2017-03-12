<?php

/*
 * This file is part of the EUCookieLawBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\EUCookieLawBundle\EventSubscriber;

use LeblancSimon\EUCookieLawBundle\Injector\EUCookieLawTemplate;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class EUCookieLawDivSubscriber implements EventSubscriberInterface
{
    /**
     * @var EUCookieLawTemplate
     */
    private $injector;

    /**
     * EUCookieLawDivSubscriber constructor.
     *
     * @param EUCookieLawTemplate $template_injector
     */
    public function __construct(EUCookieLawTemplate $template_injector)
    {
        $this->injector = $template_injector;
    }

    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse', -128],
        ];
    }

    /**
     * Inject the cookie law template
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $this->injector->inject($event->getResponse(), $event->getRequest());
    }
}
