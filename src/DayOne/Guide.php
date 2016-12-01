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
     * Navigate direction instructions
     *
     * @param   string  $instructions
     * @param   bool    $resetPosition
     * @return  int
     */
    public function navigate($instructions, $resetPosition = false)
    {
        ! $resetPosition || $this->resetPosition();

        foreach (explode(', ', $instructions) as $instruction) {
            $this->follow($instruction);
        }

        $fewestSteps = array_sum($this->location);

        return $fewestSteps < 0 ? -$fewestSteps : $fewestSteps;
    }

    /**
     * Follow an instruction
     *
     * @param   string $instruction
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
     * @param $steps
     */
    private function takeSteps($steps)
    {
        switch ($this->currentDirection) {
            case 0:
                $this->location[1] += $steps;
                break;
            case 1:
                $this->location[0] += $steps;
                break;
            case 2:
                $this->location[1] -= $steps;
                break;
            case 3:
                $this->location[0] -= $steps;
                break;
        }
    }

    private function resetPosition()
    {
        $this->currentDirection = 0;
        $this->location = [0, 0];
    }
}
