<?php 

declare(strict_types=1);

namespace App\MatchMaker;

use \App\MatchMaker\Players\Player;
use \App\MatchMaker\Players\QueuingPlayer;

interface CanAddPlayers 
{
    public function addPlayer(Player $player): void;
}

class Lobby implements CanAddPlayers
{
    public array $queuingPlayers = [];

    public function findOponents(QueuingPlayer $player): array
    {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, 
            static function (QueuingPlayer $potentialOponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOponent->getRatio() / 100);

            return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function addPlayer(Player $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function addPlayers(Player ...$players): void // the dots: packing, used when we do not know the number of args
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }
}