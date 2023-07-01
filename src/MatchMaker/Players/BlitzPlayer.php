<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

use \App\MatchMaker\Players\Player;
use \App\MatchMaker\Players\AbstractPlayer;

final class BlitzPlayer extends Player 
{
    const RATIO_INIT = 1200.0;

    public function __construct (protected string $name="anonymous", protected float $ratio = NAN)
    {
        if ($this->ratio = NAN) {
            $this->ratio = static::RATIO_INIT;
        }

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function updateRatioAgainst(AbstractPlayer $player, int $result): void
    {
        $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
    }

}