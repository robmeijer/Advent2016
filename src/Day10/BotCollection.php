<?php

namespace Advent2016\Day10;

use Advent2016\Advent2016;

class BotCollection extends Advent2016
{
    /**
     * Collection of bots
     *
     * @var array
     */
    private $bots = [];

    /**
     * Collection of outputs
     *
     * @var array
     */
    private $outputs = [];

    /**
     * Process all instructions
     */
    public function processInstructions()
    {
        array_map(function ($instruction) {
            $this->execute(new Instruction($instruction));
        }, $this->input());
    }

    /**
     * The bots
     *
     * @param   bool|int    $id
     * @return  Bot|array
     */
    public function bots($id = false)
    {
        return $id ? $this->bots[$id] : $this->bots;
    }

    /**
     * The outputs
     *
     * @param   bool|int        $id
     * @return  array|Output
     */
    public function outputs($id = false)
    {
        return $id === false ? $this->outputs : $this->outputs[$id];
    }

    /**
     * Execute given instruction
     *
     * @param   Instruction $instruction
     */
    private function execute(Instruction $instruction)
    {
        if ($instruction->bot() !== null) {
            $target = $this->addBot($instruction->bot());
        } else {
            $target = $this->addOutput($instruction->output());
        }

        $target->processInstruction($instruction);

        if ($target->hasInstructions()) {
            foreach ($target->instructions() as $instruction) {
                $this->execute($instruction);
            }
        }
    }

    /**
     * Add bot to collection
     *
     * @param   $botId
     * @return  Bot
     */
    private function addBot($botId)
    {
        if (! isset($this->bots[$botId])) {
            $this->bots[$botId] = New Bot($botId);
        }

        return $this->bots[$botId];
    }

    /**
     * Add output to collection
     *
     * @param   $outputId
     * @return  Output
     */
    private function addOutput($outputId)
    {
        if (! isset($this->outputs[$outputId])) {
            $this->outputs[$outputId] = New Output($outputId);
        }

        return $this->outputs[$outputId];
    }
}
