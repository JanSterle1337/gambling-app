<?php

namespace App\Service;

use App\Entity\Combination;

class MatchNumbersToCombination
{
    private Combination $combination1;
    private Combination $combination2;

    public function __construct(Combination $combination1, Combination $combination2)
    {
        $this->combination1 = $combination1;
        $this->combination2 = $combination2;
    }

    public function createIntersectedCombination(): Combination
    {
        $matchedNumbers = array_intersect($this->combination1->getCombinationElements(), $this->combination2->getCombinationElements());
        sort($matchedNumbers); //converts array to an indexed normalized array
        return new Combination($matchedNumbers, $this->combination1->game);
    }
}