<?php

namespace App\Repository;

use App\Entity\Game;
use PDO;

class GameRepository
{
    protected PDO $databaseConnection;

    public function __construct(PDO $userConnection)
    {
        $this->databaseConnection = $userConnection;
    }

    public function getGameRules($id): Game
    {
        $sql = "SELECT
                id,
                name,
                minimum,
                maximum,
                howManyNumbers
                FROM games
                WHERE id = :id";
        $statement = $this->databaseConnection->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rules = $data[0];

        return new Game(
            $rules["id"],
            $rules["name"],
            $rules["minimum"],
            $rules["maximum"],
            $rules["howManyNumbers"]
        );

    }

}