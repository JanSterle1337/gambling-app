<?php

namespace App\Service;

use App\Entity\Combination;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CombinationGenerator
{
    private int $howManyNumbers;
    private int $max;
    private int $min;
    private Game $game;

    public function __construct(Game $game) //rules and uniqueNumbers method
    {
        $this->game = $game;
        $this->howManyNumbers = $game->getHowManyNumbers();
        $this->max = $game->getMaximum();
        $this->min = $game->getMinimum();
    }

    public function generateCombination(): Combination //Combination object
    {
        $data = [];
        do {
            $number = random_int($this->game->getMinimum(), $this->game->getMaximum());

            if (!in_array($number, $data)) {
                $data[] = $number;
            }


        } while (count($data) < $this->game->getHowManyNumbers());

        return new Combination($data, $this->game);

    }
}