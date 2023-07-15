<?php

namespace App\Entity;

class Game
{
    private int $id;
    private string $name;
    private int $maximum;
    private int $minimum;
    private int $howManyNumbers;

    public function __construct
    (
        int $id,
        string $name,
        int $minimum,
        int $maximum,
        int $howManyNumbers
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->maximum = $maximum;
        $this->minimum = $minimum;
        $this->howManyNumbers = $howManyNumbers;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }/**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }/**
     * @return int
     */
    public function getMaximum(): int
    {
        return $this->maximum;
    }/**
     * @return int
     */
    public function getMinimum(): int
    {
        return $this->minimum;
    }/**
     * @return int
     */
    public function getHowManyNumbers(): int
    {
        return $this->howManyNumbers;
    }
}