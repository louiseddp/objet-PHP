<?php 

declare(strict_types=1);

namespace App\MatchMaker\Players;

interface HasName 
{
    public function getName(): string;
}

interface HasRatio 
{
    public function getRatio(): float;
}

interface HasRatioAndName extends HasName, HasRatio 
{

}

abstract class AbstractPlayer implements HasRatioAndName
{
    const RATIO_INIT = 400.0;

    public function __construct (protected string $name, protected float $ratio = self::RATIO_INIT)
    {

    }
    
    abstract protected function probabilityAgainst (self $player): float;

    abstract protected function updateRatioAgainst (self $player, int $result): void;

    abstract public function getName(): string;

    abstract public function getRatio(): float;

}