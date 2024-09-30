<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory {
    use Nette\StaticClass;

    public static function createRouter(): RouteList {
        $router = new RouteList;

        $router->addRoute('/pet/findByStatus', 'Pet:findByStatus');
        $router->addRoute('/pet/findByTags', 'Pet:findByTags');
        $router->addRoute('/pet/<id>/uploadImage', 'Pet:uploadImage');
        $router->addRoute('/pet/[<id>]', 'Pet:default');

        $router->addRoute('/tag/[<id>]', 'Tag:default');

        $router->addRoute('/category/[<id>]', 'Category:default');

        $router->addRoute('/store/dashboard', 'Order:dashboard');
        $router->addRoute('/store/inventory', 'Order:inventory');
        $router->addRoute('/store/order/[<id>]', 'Order:default');

        $router->addRoute('/user/createWithList', 'User:createWithList');
        $router->addRoute('/user/list', 'User:list');
        $router->addRoute('/user/login', 'User:login');
        $router->addRoute('/user/logout', 'User:logout');
        $router->addRoute('/user/me', 'User:me');
        $router->addRoute('/user/[<id>]', 'User:default');

        return $router;
    }
}
