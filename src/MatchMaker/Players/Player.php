<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

use \App\MatchMaker\Players\AbstractPlayer;

class Player extends AbstractPlayer
{

    public function getName(): string
    {
        return $this->name;
    }

    protected function probabilityAgainst(parent $player): float
    {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public function updateRatioAgainst(parent $player, int $result): void
    {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }

    public function getRatio(): float
    {
        return $this->ratio;
    }
}
