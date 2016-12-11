<?php

namespace Advent2016\Day10;

class Output
{
    /**
     * Output ID
     *
     * @var int
     */
    protected $id;

    /**
     * Current value held
     *
     * @var int
     */
    protected $value;

    /**
     * Output constructor.
     *
     * @param   $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param Instruction $instruction
     */
    public function processInstruction(Instruction $instruction)
    {
        switch ($instruction->type()) {
            case 'chip':
                $this->addValue($instruction->chip());
        }
    }

    /**
     * Dummy method
     *
     * @return bool
     */
    public function hasInstructions()
    {
        return false;
    }

    /**
     * Return held value
     *
     * @return  int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Add value
     *
     * @param $value
     */
    private function addValue($value)
    {
        $this->value = $value;
    }
}
