<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

use \App\MatchMaker\Players\Player;

class QueuingPlayer

{
    public function __construct(public Player $player, protected int $range = 1)
    {
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function upgradeRange(): void
    {
        $this->range = min($this->range + 1, 40);
    }

    public function getPlayer(): getPlayer
    {
        return $this->player;
    }

    public function updateRatioAgainst(Player $player, int $result): void
    {
        $this->player->updateRatioAgainst($player, $result);
    }

    public function getRatio(): float
    {
        return $this->player->getRatio();
    }
    
}