<?php

namespace Advent2016\Day12;

use Advent2016\Advent2016;

class Checker extends Advent2016
{
    /**
     * Register values
     *
     * @var array
     */
    private $registers = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0];

    /**
     * Initialise the registers with given values
     *
     * @param   int $a
     * @param   int $b
     * @param   int $c
     * @param   int $d
     */
    public function init($a = 0, $b = 0, $c = 0, $d = 0)
    {
        $this->registers['a'] = $a;
        $this->registers['b'] = $b;
        $this->registers['c'] = $c;
        $this->registers['d'] = $d;
    }

    /**
     * Process the instructions
     */
    public function processInstructions()
    {
        for ($i = 0; $i < count($this->input()); $i++) {
            if ($jumps = $this->processInstruction($this->input()[$i])) {
                $i = $i + $jumps - 1;
            }
        }
    }

    /**
     * Return registers
     *
     * @param   bool    $id
     * @return  array
     */
    public function registers($id = false)
    {
        return $id === false ? $this->registers : $this->registers[$id];
    }

    /**
     * Process the given instruction
     *
     * @param   $instruction
     * @return  null
     */
    private function processInstruction($instruction)
    {
        $instruction = explode(' ', $instruction);

        switch ($instruction[0]) {
            case 'cpy':
                $this->registers[$instruction[2]] = (int) $this->getValue($instruction[1]);
                break;
            case 'inc':
                $this->registers[$instruction[1]]++;
                break;
            case 'dec':
                $this->registers[$instruction[1]]--;
                break;
            case 'jnz':
                if ($this->getValue($instruction[1])) {
                    return $instruction[2];
                }
                break;
        }

        return null;
    }

    /**
     * Supply a value to the instruction
     *
     * @param   $value
     * @return  int
     */
    private function getValue($value)
    {
        return is_numeric($value) ? $value : $this->registers[$value];
    }
}
