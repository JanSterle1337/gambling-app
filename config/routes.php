<?php

use App\Controller\LotoController;
use App\Controller\HomeController;
use App\Controller\GamesController;
use App\Controller\KrnekiController;
use App\Controller\DhiLotoController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


$home = new Route(
    '/',
    array([HomeController::class, 'showAction'])
);

$games = new Route(
    '/games',
    array([GamesController::class, 'showAction'])
);

/*$game = new Route(
    '/games/{id}',
    array([GamesController::class, 'processAction']),
    array('id' => '\d+')
);*/

$loto = new Route(
  '/games/1',
  array([LotoController::class, 'showAction']),
    [],
    [],
    '',
    [],
    ['GET']
);

$lotoPost = new Route(
    '/games/1',
    array([LotoController::class, 'playAction']),
    [],
    [],
    '',
    [],
    ['POST']
);

$dhiLoto = new Route(
    '/games/2',
    array([DhiLotoController::class, 'showAction'])
);
/*
$jackpot = new Route(
    '/games/3',
    array([JackpotController::class, 'showAction'])
);*/
$collection = new RouteCollection();
$collection->add('_home', $home);
$collection->add('_games', $games);
$collection->add('_loto', $loto);
$collection->add('_dhiLoto', $dhiLoto);
$collection->add('_lotoPost', $lotoPost);


return $collection;
