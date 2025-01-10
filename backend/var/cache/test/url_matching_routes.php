<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/auth/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\AuthController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/category/create' => [[['_route' => 'create_category', '_controller' => 'App\\Controller\\CategoryController::createCategory'], null, ['POST' => 0], null, false, false, null]],
        '/api/category/all' => [[['_route' => 'get_all_categories', '_controller' => 'App\\Controller\\CategoryController::getAllCategories'], null, ['GET' => 0], null, false, false, null]],
        '/api/member/create' => [[['_route' => 'create_member', '_controller' => 'App\\Controller\\MemberController::createMember'], null, ['POST' => 0], null, false, false, null]],
        '/api/member/all' => [[['_route' => 'get_all_members', '_controller' => 'App\\Controller\\MemberController::getAllMembers'], null, ['GET' => 0], null, false, false, null]],
        '/api/notification/create' => [[['_route' => 'create_notification', '_controller' => 'App\\Controller\\NotificationController::createNotification'], null, ['POST' => 0], null, false, false, null]],
        '/api/notification/all' => [[['_route' => 'get_all_notifications', '_controller' => 'App\\Controller\\NotificationController::getAllNotifications'], null, ['GET' => 0], null, false, false, null]],
        '/api/payment/create' => [[['_route' => 'create_payment', '_controller' => 'App\\Controller\\PaymentController::createPayment'], null, ['POST' => 0], null, false, false, null]],
        '/api/payment/all' => [[['_route' => 'get_all_payments', '_controller' => 'App\\Controller\\PaymentController::getAllPayments'], null, ['GET' => 0], null, false, false, null]],
        '/api/permission/assign' => [[['_route' => 'assign_permission', '_controller' => 'App\\Controller\\PermissionController::assignPermission'], null, ['POST' => 0], null, false, false, null]],
        '/api/service/create' => [[['_route' => 'create_service', '_controller' => 'App\\Controller\\ServiceController::createService'], null, ['POST' => 0], null, false, false, null]],
        '/api/service/all' => [[['_route' => 'get_all_services', '_controller' => 'App\\Controller\\ServiceController::getAllServices'], null, ['GET' => 0], null, false, false, null]],
        '/api/space/create' => [[['_route' => 'create_space', '_controller' => 'App\\Controller\\SpaceController::createSpace'], null, ['POST' => 0], null, false, false, null]],
        '/api/space/all' => [[['_route' => 'get_all_spaces', '_controller' => 'App\\Controller\\SpaceController::getAllSpaces'], null, ['GET' => 0], null, false, false, null]],
        '/api/subscription/create' => [[['_route' => 'create_subscription', '_controller' => 'App\\Controller\\SubscriptionController::createSubscription'], null, ['POST' => 0], null, false, false, null]],
        '/api/subscription-tag/create' => [[['_route' => 'create_subscription_tag', '_controller' => 'App\\Controller\\SubscriptionTagController::create'], null, ['POST' => 0], null, false, false, null]],
        '/api/subscription-tag/all' => [[['_route' => 'get_all_subscription_tags', '_controller' => 'App\\Controller\\SubscriptionTagController::getAll'], null, ['GET' => 0], null, false, false, null]],
        '/api/tag/create' => [[['_route' => 'create_tag', '_controller' => 'App\\Controller\\TagController::createTag'], null, ['POST' => 0], null, false, false, null]],
        '/api/tag/all' => [[['_route' => 'get_all_tags', '_controller' => 'App\\Controller\\TagController::getAllTags'], null, ['GET' => 0], null, false, false, null]],
        '/api/user/create' => [[['_route' => 'create_user', '_controller' => 'App\\Controller\\UserController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/all' => [[['_route' => 'get_all_users', '_controller' => 'App\\Controller\\UserController::getAllUsers'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api/(?'
                    .'|category/(?'
                        .'|([^/]++)(*:35)'
                        .'|update/([^/]++)(*:57)'
                        .'|delete/([^/]++)(*:79)'
                    .')'
                    .'|member/(?'
                        .'|([^/]++)(*:105)'
                        .'|update/([^/]++)(*:128)'
                        .'|delete/([^/]++)(*:151)'
                    .')'
                    .'|notification/(?'
                        .'|([^/]++)(*:184)'
                        .'|mark\\-read/([^/]++)(*:211)'
                        .'|delete/([^/]++)(*:234)'
                    .')'
                    .'|p(?'
                        .'|ayment/(?'
                            .'|([^/]++)(*:265)'
                            .'|update/([^/]++)(*:288)'
                            .'|delete/([^/]++)(*:311)'
                        .')'
                        .'|ermission/(?'
                            .'|user/([^/]++)(*:346)'
                            .'|revoke/([^/]++)(*:369)'
                        .')'
                    .')'
                    .'|s(?'
                        .'|ervice/(?'
                            .'|([^/]++)(*:401)'
                            .'|update/([^/]++)(*:424)'
                            .'|delete/([^/]++)(*:447)'
                        .')'
                        .'|pace/(?'
                            .'|([^/]++)(*:472)'
                            .'|archive/([^/]++)(*:496)'
                            .'|delete/([^/]++)(*:519)'
                        .')'
                        .'|ubscription(?'
                            .'|/(?'
                                .'|([^/]++)(*:554)'
                                .'|all(*:565)'
                                .'|update/([^/]++)(*:588)'
                                .'|delete/([^/]++)(*:611)'
                            .')'
                            .'|\\-tag/(?'
                                .'|([^/]++)(*:637)'
                                .'|delete/([^/]++)(*:660)'
                            .')'
                        .')'
                    .')'
                    .'|tag/delete/([^/]++)(*:690)'
                    .'|user/(?'
                        .'|([^/]++)(?'
                            .'|(*:717)'
                        .')'
                        .'|delete/([^/]++)(*:741)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => 'get_category_by_id', '_controller' => 'App\\Controller\\CategoryController::getCategoryById'], ['id'], ['GET' => 0], null, false, true, null]],
        57 => [[['_route' => 'update_category', '_controller' => 'App\\Controller\\CategoryController::updateCategory'], ['id'], ['PUT' => 0], null, false, true, null]],
        79 => [[['_route' => 'delete_category', '_controller' => 'App\\Controller\\CategoryController::deleteCategory'], ['id'], ['DELETE' => 0], null, false, true, null]],
        105 => [[['_route' => 'get_member_by_id', '_controller' => 'App\\Controller\\MemberController::getMemberById'], ['id'], ['GET' => 0], null, false, true, null]],
        128 => [[['_route' => 'update_member', '_controller' => 'App\\Controller\\MemberController::updateMember'], ['id'], ['PUT' => 0], null, false, true, null]],
        151 => [[['_route' => 'delete_member', '_controller' => 'App\\Controller\\MemberController::deleteMember'], ['id'], ['DELETE' => 0], null, false, true, null]],
        184 => [[['_route' => 'get_notification_by_id', '_controller' => 'App\\Controller\\NotificationController::getNotificationById'], ['id'], ['GET' => 0], null, false, true, null]],
        211 => [[['_route' => 'mark_notification_read', '_controller' => 'App\\Controller\\NotificationController::markNotificationAsRead'], ['id'], ['PATCH' => 0], null, false, true, null]],
        234 => [[['_route' => 'delete_notification', '_controller' => 'App\\Controller\\NotificationController::deleteNotification'], ['id'], ['DELETE' => 0], null, false, true, null]],
        265 => [[['_route' => 'get_payment_by_id', '_controller' => 'App\\Controller\\PaymentController::getPaymentById'], ['id'], ['GET' => 0], null, false, true, null]],
        288 => [[['_route' => 'update_payment', '_controller' => 'App\\Controller\\PaymentController::updatePayment'], ['id'], ['PUT' => 0], null, false, true, null]],
        311 => [[['_route' => 'delete_payment', '_controller' => 'App\\Controller\\PaymentController::deletePayment'], ['id'], ['DELETE' => 0], null, false, true, null]],
        346 => [[['_route' => 'get_user_permissions', '_controller' => 'App\\Controller\\PermissionController::getUserPermissions'], ['id'], ['GET' => 0], null, false, true, null]],
        369 => [[['_route' => 'revoke_permission', '_controller' => 'App\\Controller\\PermissionController::revokePermission'], ['id'], ['DELETE' => 0], null, false, true, null]],
        401 => [[['_route' => 'get_service_by_id', '_controller' => 'App\\Controller\\ServiceController::getServiceById'], ['id'], ['GET' => 0], null, false, true, null]],
        424 => [[['_route' => 'update_service', '_controller' => 'App\\Controller\\ServiceController::updateService'], ['id'], ['PUT' => 0], null, false, true, null]],
        447 => [[['_route' => 'delete_service', '_controller' => 'App\\Controller\\ServiceController::deleteService'], ['id'], ['DELETE' => 0], null, false, true, null]],
        472 => [[['_route' => 'get_space_by_id', '_controller' => 'App\\Controller\\SpaceController::getSpaceById'], ['id'], ['GET' => 0], null, false, true, null]],
        496 => [[['_route' => 'archive_space', '_controller' => 'App\\Controller\\SpaceController::archiveSpace'], ['id'], ['PATCH' => 0], null, false, true, null]],
        519 => [[['_route' => 'delete_space', '_controller' => 'App\\Controller\\SpaceController::deleteSpace'], ['id'], ['DELETE' => 0], null, false, true, null]],
        554 => [[['_route' => 'get_subscription', '_controller' => 'App\\Controller\\SubscriptionController::getSubscription'], ['id'], ['GET' => 0], null, false, true, null]],
        565 => [[['_route' => 'get_all_subscriptions', '_controller' => 'App\\Controller\\SubscriptionController::getAllSubscriptions'], [], ['GET' => 0], null, false, false, null]],
        588 => [[['_route' => 'update_subscription', '_controller' => 'App\\Controller\\SubscriptionController::updateSubscription'], ['id'], ['PUT' => 0], null, false, true, null]],
        611 => [[['_route' => 'delete_subscription', '_controller' => 'App\\Controller\\SubscriptionController::deleteSubscription'], ['id'], ['DELETE' => 0], null, false, true, null]],
        637 => [[['_route' => 'get_subscription_tag', '_controller' => 'App\\Controller\\SubscriptionTagController::getById'], ['id'], ['GET' => 0], null, false, true, null]],
        660 => [[['_route' => 'delete_subscription_tag', '_controller' => 'App\\Controller\\SubscriptionTagController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        690 => [[['_route' => 'delete_tag', '_controller' => 'App\\Controller\\TagController::deleteTag'], ['id'], ['DELETE' => 0], null, false, true, null]],
        717 => [
            [['_route' => 'get_user_by_id', '_controller' => 'App\\Controller\\UserController::getUserById'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_user', '_controller' => 'App\\Controller\\UserController::updateUser'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        741 => [
            [['_route' => 'delete_user', '_controller' => 'App\\Controller\\UserController::deleteUser'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
