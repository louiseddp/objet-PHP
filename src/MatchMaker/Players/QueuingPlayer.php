<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

use \App\MatchMaker\Players\Player;

final class QueuingPlayer extends Player 

{
    public function __construct(Player $player, protected int $range = 1)
    {
        parent::__construct($player->getName(), $player->getRatio());
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function upgradeRange(): void
    {
        $this->range = min($this->range + 1, 40);
    }
    
}