<?php

namespace Advent2016\Day10;

class Instruction
{
    /**
     * @var int
     */
    private $bot;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $chip;

    /**
     * @var int
     */
    private $lowTarget;

    /**
     * @var int
     */
    private $highTarget;

    /**
     * @var string
     */
    private $lowTargetType;

    /**
     * @var string
     */
    private $highTargetType;

    /**
     * @var int
     */
    private $output;

    /**
     * Instruction constructor.
     *
     * @param   string  $instruction
     */
    public function __construct($instruction)
    {
        $this->processInstruction($instruction);
    }

    /**
     * @return  int
     */
    public function bot()
    {
        return $this->bot;
    }

    /**
     * @return  int
     */
    public function output()
    {
        return $this->output;
    }

    /**
     * @return  string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return  int
     */
    public function chip()
    {
        return $this->chip;
    }

    /**
     * @return  array
     */
    public function lowTarget()
    {
        return [$this->lowTargetType, $this->lowTarget];
    }

    /**
     * @return  array
     */
    public function highTarget()
    {
        return [$this->highTargetType, $this->highTarget];
    }

    /**
     * @param   string  $instruction
     */
    private function processInstruction($instruction)
    {
        $instruction = explode(' ', $instruction);
        switch ($instruction[0]) {
            case 'value':
                $this->type = 'chip';
                $this->chip = $instruction[1];
                if ($instruction[4] == 'bot') {
                    $this->bot = $instruction[5];
                } else {
                    $this->output = $instruction[5];
                }
                break;
            case 'bot':
                $this->type = 'transfer';
                $this->bot = $instruction[1];
                $this->lowTargetType = $instruction[5];
                $this->lowTarget = $instruction[6];
                $this->highTargetType = $instruction[10];
                $this->highTarget = $instruction[11];
                break;
        }
    }
}
