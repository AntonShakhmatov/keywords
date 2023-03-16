<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->withModule('key')
			->addRoute('key', 'Key:default')
            ->addRoute('<presenter>/<action>');
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		$router->addRoute('<presenter>/<action>[/<id>]', 'Mail:default');

		return $router;
	}
}
