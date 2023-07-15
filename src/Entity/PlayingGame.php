<?php

namespace App\Entity;

class PlayingGame
{
    public ?int $id;
    private Combination $playedCombination;
    private Combination $generatedCombination;
    private Combination $matchedNumbersCombination;
    private Game $game;

    public function __construct
    (
        Combination $playedCombination,
        Combination $generatedCombination,
        Combination $matchedNumbersCombination,
        Game $game
    )
    {
        $this->playedCombination = $playedCombination;
        $this->generatedCombination = $generatedCombination;
        $this->matchedNumbersCombination = $matchedNumbersCombination;
        $this->game = $game;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Combination
     */
    public function getPlayedCombination(): Combination
    {
        return $this->playedCombination;
    }

    /**
     * @return Combination
     */
    public function getGeneratedCombination(): Combination
    {
        return $this->generatedCombination;
    }

    /**
     * @return Combination
     */
    public function getMatchedNumbersCombination(): Combination
    {
        return $this->matchedNumbersCombination;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

}