<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory {
    use Nette\StaticClass;

    public static function createRouter(): RouteList {
        $router = new RouteList;
//        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        $router->addRoute('/pet/findByStatus', 'Pet:findByStatus');
        $router->addRoute('/pet/findByTags', 'Pet:findByTags');
        $router->addRoute('/pet/<id>/uploadImage', 'Pet:uploadImage');

        $router->addRoute('/pet/[<id>]', 'Pet:default');

        $router->addRoute('/tag/[<id>]', 'Tag:default');

        $router->addRoute('/store/inventory', 'Order:inventory');
        $router->addRoute('/store/order/[<id>]', 'Order:default');

        $router->addRoute('/user/createCreateWithList', 'User:createCreateWithList');
        $router->addRoute('/user/login', 'User:login');
        $router->addRoute('/user/logout', 'User:logout');
        $router->addRoute('/user/[<id>]', 'User:default');

        return $router;
    }
}
