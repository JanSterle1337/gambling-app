<?php

namespace App\Repository;

use App\Entity\PlayingGame;
use PDO;

class PlayingGameRepository
{
    private PDO $databaseConnection;

    public function __construct(PDO $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function saveGameData(PlayingGame $playingGame): void
    {
        $combinations = array(
            "played_combination" => $playingGame->getPlayedCombination()->getCombinationElements(),
            "generated_combination" => $playingGame->getGeneratedCombination()->getCombinationElements(),
            "matched_numbers_combination" => $playingGame->getMatchedNumbersCombination()->getCombinationElements()
        );

        $combinations = json_encode($combinations);

        $sql = "INSERT INTO playing_game (combinations, game_name) VALUES (:combinations, :name)";
        $statement = $this->databaseConnection->prepare($sql);
        $statement->bindParam(':combinations', $combinations);

        $gameName = $playingGame->getGame()->getName();
        $statement->bindParam(':name', $gameName);

        $statement->execute();
    }
}