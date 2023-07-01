<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

abstract class AbstractPlayer
{
    public float $RATIO_INIT = 400.0;

    public function __construct (protected string $name, protected float $ratio = self::RATIO_INIT)
    {

    }
    
    abstract protected function probabilityAgainst (self $player): float;

    abstract protected function updateRatioAgainst (self $player, int $result): void;

    abstract public function getname(): string;

    abstract public function getRatio(): float;

}