<?php

namespace ContainerI4qD5Wk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getClockService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'clock' shared service.
     *
     * @return \Symfony\Component\Clock\Clock
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/psr/clock/src/ClockInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/clock/ClockInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/clock/Clock.php';

        return $container->privates['clock'] = new \Symfony\Component\Clock\Clock();
    }
}
