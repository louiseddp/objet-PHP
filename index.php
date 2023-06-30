<?php
class Encounter 
{
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    public const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];
    public static function probabilityAgainst(Player $playerOne, Player $playerTwo) : float {
        return 1/(1+(10 ** (($playerTwo->__get("level") - $playerOne->__get("level"))/400)));
    }

    public static function setNewLevel(Player $playerOne, Player $playerTwo, int $playerOneResult): void {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s',implode(' or ', self::RESULT_POSSIBILITIES)));
        }
    
        $playerOne->__set("level", 
            $playerOne->__get("level") + (int) (32 * ($playerOneResult - self::probabilityAgainst($playerOne, $playerTwo))));
    }
}

class Player 
{
    public function __construct (private int $level) {
    }
    public function __get (string $name) {
        return $this->{$name};
    }
    public function __set (string $name, $value) : void {
        $this->{$name} = $value;
    }
    
}

$greg= new Player(400);
$jade= new Player(800);

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    Encounter::probabilityAgainst($greg, $jade)*100
).PHP_EOL;

// Imaginons que greg l'emporte tout de même.
Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->level,
    $jade->level
);

class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
 
    public function __construct(public string $username, public string $status = self::STATUS_ACTIVE)
    {
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
            trigger_error(sprintf('Le status %s n\'est pas valide. 
            Les status possibles sont : %s', $status,
            implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE])), E_USER_ERROR);
        };

        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
 
class Admin extends User
{
    // Ajout d'un tableau de roles pour affiner les droits des administrateurs :)
    public function __construct(public string $username, 
        public array $roles = [], public string $status = self::STATUS_ACTIVE)
    {
    }
 
    // Méthode d'ajout d'un rôle, puis on supprime les doublons avec array_filter.
    public function addRole(string $role): void
    {
        $this->roles[] = $role;
        $this->roles = array_filter($this->roles);
    }
 
    // Méthode de renvoie des rôles, dans lequel on définit le rôle ADMIN par défaut.
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ADMIN';
 
        return $roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}

exit(0);
