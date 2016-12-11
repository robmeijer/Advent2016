<?php

namespace Advent2016\Day10;

class Bot
{
    /**
     * Max number of chips
     */
    const MAX_CHIPS = 2;

    /**
     * Bot ID
     *
     * @var int
     */
    private $id;

    /**
     * Current chips held
     *
     * @var array
     */
    private $chips = [];

    /**
     * List of chips compared
     *
     * @var array
     */
    private $chipsCompared = [];

    /**
     * List of instructions
     *
     * @var array
     */
    private $instructions = [];

    /**
     * Target for low chip number
     *
     * @var int
     */
    private $lowTarget;

    /**
     * Target for high chip number
     *
     * @var int
     */
    private $highTarget;

    /**
     * Bot is the winner
     *
     * @var bool
     */
    private $winner = false;

    /**
     * Bot constructor.
     *
     * @param   $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param   Instruction $instruction
     */
    public function processInstruction(Instruction $instruction)
    {
        switch ($instruction->type()) {
            case 'transfer':
                $this->lowTarget = $instruction->lowTarget();
                $this->highTarget = $instruction->highTarget();
                break;
            case 'chip':
                $this->addChip($instruction->chip());
                break;
        }

        $this->audit();
    }

    /**
     * Check if there are instructions
     *
     * @return  bool
     */
    public function hasInstructions()
    {
        return ! empty($this->instructions);
    }

    /**
     * @return  int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return  array
     */
    public function instructions()
    {
        return $this->instructions;
    }

    /**
     * @return  array
     */
    public function compared()
    {
        return $this->chipsCompared;
    }

    /**
     * @return  bool
     */
    public function winner()
    {
        return $this->winner;
    }

    /**
     * Create instructions once both high and low values and their targets are set
     */
    private function compare()
    {
        if (isset($this->chips[0]) && isset($this->chips[1])) {
            sort($this->chips);
            $this->chipsCompared[] = $this->chips;
            if (in_array([17, 61], $this->chipsCompared)) {
                $this->winner = true;
            }
            $this->instructions[] = $this->makeInstruction($this->chips[0], $this->lowTarget[0], $this->lowTarget[1]);
            $this->instructions[] = $this->makeInstruction($this->chips[1], $this->highTarget[0], $this->highTarget[1]);
        }
    }

    /**
     * @param   int $chip
     */
    private function addChip($chip)
    {
        $this->chips[] = $chip;
    }

    /**
     * @param   string      $value
     * @param   string      $targetType
     * @param   string      $target
     * @return  Instruction
     */
    private function makeInstruction($value, $targetType, $target)
    {
        return new Instruction('value ' . $value . ' goes to ' . $targetType . ' ' . $target);
    }

    /**
     * Check bot has targets set
     *
     * @return  bool
     */
    private function hasTargets()
    {
        return (! empty($this->highTarget) && ! empty($this->lowTarget));
    }

    /**
     * Check if instructions can be created
     */
    private function audit()
    {
        if (count($this->chips) === self::MAX_CHIPS && $this->hasTargets()) {
            $this->compare();
        }
    }
}
