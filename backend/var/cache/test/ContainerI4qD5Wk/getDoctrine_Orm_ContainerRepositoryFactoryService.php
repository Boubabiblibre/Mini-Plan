<?php

namespace ContainerI4qD5Wk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrine_Orm_ContainerRepositoryFactoryService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine.orm.container_repository_factory' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/src/Repository/RepositoryFactory.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/src/Repository/RepositoryFactoryCompatibility.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/src/Repository/ContainerRepositoryFactory.php';

        return $container->privates['doctrine.orm.container_repository_factory'] = new \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Repository\\CategoryRepository' => ['privates', 'App\\Repository\\CategoryRepository', 'getCategoryRepositoryService', true],
            'App\\Repository\\MemberRepository' => ['privates', 'App\\Repository\\MemberRepository', 'getMemberRepositoryService', true],
            'App\\Repository\\NotificationRepository' => ['privates', 'App\\Repository\\NotificationRepository', 'getNotificationRepositoryService', true],
            'App\\Repository\\NotificationTargetRepository' => ['privates', 'App\\Repository\\NotificationTargetRepository', 'getNotificationTargetRepositoryService', true],
            'App\\Repository\\PaymentRepository' => ['privates', 'App\\Repository\\PaymentRepository', 'getPaymentRepositoryService', true],
            'App\\Repository\\PermissionRepository' => ['privates', 'App\\Repository\\PermissionRepository', 'getPermissionRepositoryService', true],
            'App\\Repository\\ServiceRepository' => ['privates', 'App\\Repository\\ServiceRepository', 'getServiceRepositoryService', true],
            'App\\Repository\\SpaceRepository' => ['privates', 'App\\Repository\\SpaceRepository', 'getSpaceRepositoryService', true],
            'App\\Repository\\SubscriptionRepository' => ['privates', 'App\\Repository\\SubscriptionRepository', 'getSubscriptionRepositoryService', true],
            'App\\Repository\\SubscriptionTagRepository' => ['privates', 'App\\Repository\\SubscriptionTagRepository', 'getSubscriptionTagRepositoryService', true],
            'App\\Repository\\TagRepository' => ['privates', 'App\\Repository\\TagRepository', 'getTagRepositoryService', true],
            'App\\Repository\\UserRepository' => ['privates', 'App\\Repository\\UserRepository', 'getUserRepositoryService', true],
        ], [
            'App\\Repository\\CategoryRepository' => '?',
            'App\\Repository\\MemberRepository' => '?',
            'App\\Repository\\NotificationRepository' => '?',
            'App\\Repository\\NotificationTargetRepository' => '?',
            'App\\Repository\\PaymentRepository' => '?',
            'App\\Repository\\PermissionRepository' => '?',
            'App\\Repository\\ServiceRepository' => '?',
            'App\\Repository\\SpaceRepository' => '?',
            'App\\Repository\\SubscriptionRepository' => '?',
            'App\\Repository\\SubscriptionTagRepository' => '?',
            'App\\Repository\\TagRepository' => '?',
            'App\\Repository\\UserRepository' => '?',
        ]));
    }
}
