<?php

namespace ContainerOGRmwL2;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getServiceControllerdeleteServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Nxw1N6..App\Controller\ServiceController::deleteService()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Nxw1N6..App\\Controller\\ServiceController::deleteService()'] = ($container->privates['.service_locator.Nxw1N6.'] ?? $container->load('get_ServiceLocator_Nxw1N6_Service'))->withContext('App\\Controller\\ServiceController::deleteService()', $container);
    }
}
