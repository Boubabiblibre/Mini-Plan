<?php

namespace ContainerLQC1YB2;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNotificationControllerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'App\Controller\NotificationController' shared autowired service.
     *
     * @return \App\Controller\NotificationController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/NotificationController.php';

        $container->services['App\\Controller\\NotificationController'] = $instance = new \App\Controller\NotificationController();

        $instance->setContainer(($container->privates['.service_locator.ZyP9f7K'] ?? $container->load('get_ServiceLocator_ZyP9f7KService'))->withContext('App\\Controller\\NotificationController', $container));

        return $instance;
    }
}
