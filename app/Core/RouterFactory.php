<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

        // Pet API Routes
        $router->addRoute('api/pets[/<id>]', 'Pet:read');
        $router->addRoute('api/pets/create', 'Pet:create');
        $router->addRoute('api/pets/update/<id>', 'Pet:update');
        $router->addRoute('api/pets/delete/<id>', 'Pet:delete');

        // Tag API Routes
        $router->addRoute('api/tags[/<id>]', 'Tag:read');
        $router->addRoute('api/tags/create', 'Tag:create');
        $router->addRoute('api/tags/update/<id>', 'Tag:update');
        $router->addRoute('api/tags/delete/<id>', 'Tag:delete');

        // Order API Routes
        $router->addRoute('api/orders[/<id>]', 'Order:read');
        $router->addRoute('api/orders/create', 'Order:create');
        $router->addRoute('api/orders/update/<id>', 'Order:update');
        $router->addRoute('api/orders/delete/<id>', 'Order:delete');

        // User API Routes
        $router->addRoute('api/users[/<id>]', 'User:read');
        $router->addRoute('api/users/create', 'User:create');
        $router->addRoute('api/users/update/<id>', 'User:update');
        $router->addRoute('api/users/delete/<id>', 'User:delete');
		return $router;
	}
}
