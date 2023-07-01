<?php

declare(strict_types=1);

spl_autoload_register(static function(string $fqcn) {

    $path = str_replace(['\\', 'App'], ['/', 'src'], $fqcn).'.php';
    require_once($path);
 });

use \App\MatchMaker\Players\Player;
use \App\MatchMaker\Players\QueuingPlayer;
use \App\MatchMaker\Players\BlitzPlayer;
use \App\MatchMaker\Lobby;

$greg = new BlitzPlayer('greg');
$jade = new BlitzPlayer('jade');

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOponents($lobby->queuingPlayers[0]));
var_dump($greg->getRatio());

exit(0);