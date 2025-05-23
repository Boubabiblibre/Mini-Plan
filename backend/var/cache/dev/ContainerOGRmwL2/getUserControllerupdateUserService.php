<?php

namespace ContainerOGRmwL2;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserControllerupdateUserService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.xyKlyvo.App\Controller\UserController::updateUser()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.xyKlyvo.App\\Controller\\UserController::updateUser()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', true],
            'validator' => ['privates', 'validator', 'getValidatorService', true],
            'passwordHasher' => ['privates', 'security.user_password_hasher', 'getSecurity_UserPasswordHasherService', true],
        ], [
            'entityManager' => '?',
            'validator' => '?',
            'passwordHasher' => '?',
        ]))->withContext('App\\Controller\\UserController::updateUser()', $container);
    }
}
