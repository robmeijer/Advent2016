<?php

namespace Advent2016\DayTwo;

class Keypad
{
    /**
     * Default keypad
     *
     * @var array
     */
    protected $keypad = [
        ['X', 'X', '1', 'X', 'X'],
        ['X', '2', '3', '4', 'X'],
        ['5', '6', '7', '8', '9'],
        ['X', 'A', 'B', 'C', 'X'],
        ['X', 'X', 'D', 'X', 'X'],
    ];

    /**
     * Default current position
     *
     * @var array
     */
    protected $position = [2, 0];

    /**
     * Keypad constructor.
     *
     * @param   array|null  $position
     * @param   array|null  $keypad
     */
    public function __construct(array $position = null, array $keypad = null)
    {
        $this->position = $position ?: $this->position;
        $this->keypad = $keypad ?: $this->keypad;
    }

    /**
     * Find the number based on the directions
     *
     * @param   string  $directions
     * @return  string
     */
    public function findNumber($directions)
    {
        foreach (str_split($directions) as $direction) {
            $this->follow($direction);
        }

        return $this->keypad[$this->position[0]][$this->position[1]];
    }

    /**
     * Follow the given direction and update the current position
     *
     * @param   string  $direction
     */
    private function follow($direction)
    {
        switch ($direction) {
            case 'U':
                if ($this->canMoveVertical($direction)) {
                    $this->position[0]--;
                }
                break;
            case 'R':
                if ($this->canMoveHorizontal($direction)) {
                    $this->position[1]++;
                }
                break;
            case 'D':
                if ($this->canMoveVertical($direction)) {
                    $this->position[0]++;
                }
                break;
            case 'L':
                if ($this->canMoveHorizontal($direction)) {
                    $this->position[1]--;
                }
                break;
        }
    }

    /**
     * Check whether a horizontal move is possible
     *
     * @param   string  $direction
     * @return  bool
     */
    private function canMoveHorizontal($direction)
    {
        $position = $this->position[1];

        switch ($direction) {
            case 'L':
                $position--;
                break;
            case 'R':
                $position++;
                break;
        }

        if (
            array_key_exists($position, $this->keypad[$this->position[0]]) &&
            $this->keypad[$this->position[0]][$position] !== 'X'
        ) {
            return true;
        }

        return false;
    }

    /**
     * Check whether a vertical move is possible
     *
     * @param   string  $direction
     * @return  bool
     */
    private function canMoveVertical($direction)
    {
        $number = $this->position[0];

        switch ($direction) {
            case 'U':
                $number--;
                break;
            case 'D':
                $number++;
                break;
        }

        if (
            array_key_exists($number, $this->keypad) &&
            $this->keypad[$number][$this->position[1]] !== 'X'
        ) {
            return true;
        }

        return false;
    }
}
