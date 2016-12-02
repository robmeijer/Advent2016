<?php

namespace Advent2016\DayOne;

class Guide
{
    /**
     * The current X and Y coordinates
     *
     * @var array
     */
    protected $location = [0, 0];

    /**
     * The current direction
     *
     * @var int
     */
    protected $currentDirection = 0;

    /**
     * The entire journey
     *
     * @var array
     */
    protected $journey = [];

    /**
     * Navigate direction instructions
     *
     * @param   string  $instructions
     * @param   bool    $resetPosition
     * @return  int
     */
    public function navigate($instructions, $resetPosition = false)
    {
        ! $resetPosition || $this->resetPosition();

        $this->journey[] = $this->location;

        foreach (explode(', ', $instructions) as $instruction) {
            $this->follow($instruction);
        }

        return $this->fewestSteps($this->location);
    }

    /**
     * The location visited more than once
     *
     * @return  array
     */
    public function visitedTwice()
    {
        $journey = [];
        $duplicates = [];

        foreach ($this->journey as $location) {
            $steps = $location[0] . ' . ' . $location[1];
            if (! in_array($steps, $journey)) {
                $journey[] = $steps;
            } else {
                $duplicates[] = $location;
            }
        }

        return $duplicates[0];
    }

    /**
     * Follow an instruction
     *
     * @param   string  $instruction
     */
    private function follow($instruction)
    {
        preg_match('/([R|L])(\d+)/', $instruction, $matches);
        list($instruction, $direction, $steps) = $matches;

        $this->adjustDirection($direction);
        $this->takeSteps($steps);
    }

    /**
     * Adjust the current direction
     *
     * @param   string  $direction
     */
    private function adjustDirection($direction)
    {
        switch ($direction) {
            case 'R':
                $this->currentDirection++;
                break;
            case 'L':
                $this->currentDirection--;
                break;
        }

        if ($this->currentDirection > 3) {
            $this->currentDirection = 0;
        }

        if ($this->currentDirection < 0) {
            $this->currentDirection = 3;
        }
    }

    /**
     * Take the given number of steps
     *
     * @param   int     $steps
     */
    private function takeSteps($steps)
    {
        switch ($this->currentDirection) {
            case 0:
                for ($i = 0; $i < $steps; $i++) {
                    $this->location[1]++;
                    $this->journey[] = $this->location;
                }
                break;
            case 1:
                for ($i = 0; $i < $steps; $i++) {
                    $this->location[0]++;
                    $this->journey[] = $this->location;
                }
                break;
            case 2:
                for ($i = 0; $i < $steps; $i++) {
                    $this->location[1]--;
                    $this->journey[] = $this->location;
                }
                break;
            case 3:
                for ($i = 0; $i < $steps; $i++) {
                    $this->location[0]--;
                    $this->journey[] = $this->location;
                }
                break;
        }
    }

    /**
     * Reset position and journey
     */
    private function resetPosition()
    {
        $this->currentDirection = 0;
        $this->location = [0, 0];
        $this->journey = [];
    }

    /**
     * Calculate the fewest number of steps to the location
     *
     * @param   array   $location
     * @return  int
     */
    public function fewestSteps($location)
    {
        $locationX = $location[0] < 0 ? -$location[0] : $location[0];
        $locationY = $location[1] < 0 ? -$location[1] : $location[1];

        return $locationX + $locationY;
    }
}
