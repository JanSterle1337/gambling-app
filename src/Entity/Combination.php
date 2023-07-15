<?php

namespace App\Entity;

use App\Service\BoundaryChecker;
use App\Service\CombinationGenerator;
use App\Service\DuplicateNumberChecker;
use Exception;

class Combination
{
    private array $combinationElements;
    public Game $game;

    /**
     * @throws Exception
     */
    public function __construct
    (
        array $data,
        Game $game
    )
    {
        $this->game = $game;
        $boundaryChecker = new BoundaryChecker();
        $duplicateNumberChecker = new DuplicateNumberChecker();

        if ($boundaryChecker->isOverBoundary($data, $this->game->getMinimum(), $this->game->getMaximum()) || $duplicateNumberChecker->hasDuplicateNumbers($data)) {
            throw new Exception("Your input is incorrect");
        }

        $this->combinationElements = $data;
    }
    /**
     * @return array
     */
    public function getCombinationElements(): array
    {
        return $this->combinationElements;
    }

}