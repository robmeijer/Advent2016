<?php

namespace Advent2016\Day8;

use League\Flysystem\FilesystemInterface;

class Keypad
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var int
     */
    private $dimX = 0;

    /**
     * @var int
     */
    private $dimY = 0;

    /**
     * @var array
     */
    private $grid = [];

    /**
     * @var array
     */
    private $instructions = [];

    /**
     * Keypad constructor.
     *
     * @param   FilesystemInterface $filesystem
     * @param   int                 $dimX
     * @param   int                 $dimY
     */
    public function __construct(FilesystemInterface $filesystem, $dimX = 50, $dimY = 6)
    {
        $this->dimX = $dimX;
        $this->dimY = $dimY;
        $this->filesystem = $filesystem;

        $this->initGrid();
    }

    /**
     * Import instructions
     *
     * @param   $file
     */
    public function import($file)
    {
        $this->instructions = $this->getLines($this->filesystem->read($file));
    }

    /**
     * Get lines from given file contents
     *
     * @param   string  $contents
     * @return  array
     */
    private function getLines($contents)
    {
        preg_match_all('/.+/', $contents, $matches);

        return $matches[0];
    }

    /**
     * Follow the given instructions
     */
    public function followInstructions()
    {
        foreach ($this->instructions as $instruction) {
            preg_match('/^(?<action>rect|rotate) (?<instruction>.+)/', $instruction, $matches);

            switch ($matches['action']) {
                case 'rect':
                    $this->rect($matches['instruction']);
                    break;
                case 'rotate':
                    $this->rotate($matches['instruction']);
                    break;
            }
        }
    }

    /**
     * Count the number of active pixels in the display
     *
     * @return  number
     */
    public function countPixels()
    {
        $grid = array_map(function ($row) {
            return array_sum($row);
        }, $this->grid);

        return array_sum($grid);
    }

    /**
     * Display the current keypad
     */
    public function showKeypad()
    {
        $border = '';
        for ($i=0; $i<50; $i++) {
            $border .= '-';
        }

        echo $border . PHP_EOL;
        foreach ($this->grid as $row) {
            echo str_replace(1, '#', str_replace(0, '.', implode('', $row))) . PHP_EOL;
        }
        echo $border . PHP_EOL;
    }

    /**
     * Add a rectangle to the display
     *
     * @param $instruction
     */
    private function rect($instruction)
    {
        preg_match('/(?<x>\d+)x(?<y>\d+)/', $instruction, $matches);

        for ($i = 0; $i < $matches['y']; $i++) {
            for ($j = 0; $j < $matches['x']; $j++) {
                $this->grid[$i][$j] = 1;
            }
        }
    }

    /**
     * Rotate a row or column of the display
     *
     * @param $instruction
     */
    private function rotate($instruction)
    {
        preg_match('/^(?<element>row|column)...(?<action>\d+ by \d+)$/', $instruction, $matches);
        list($id, $value) = explode(' by ', $matches['action']);
        switch ($matches['element']) {
            case 'row':
                $row = $this->grid[$id];
                foreach ($this->grid[$id] as $key => $cell) {
                    $source = $key - $value > 0 ? $key - $value : $this->dimX + ($key - $value);
                    $source = $source == $this->dimX ? 0 : $source;
                    $row[$key] = $this->grid[$id][$source];
                }
                $this->grid[$id] = $row;
                break;
            case 'column':
                $grid = $this->grid;
                foreach ($this->grid as $key => $row) {
                    $row2 = $row;
                    $source = $key - $value > 0 ? $key - $value : $this->dimY + ($key - $value);
                    $source = $source == $this->dimY ? 0 : $source;
                    $row2[$id] = $this->grid[$source][$id];
                    $grid[$key] = $row2;
                }
                $this->grid = $grid;
                break;
        }
    }

    /**
     * Initialise the display
     */
    private function initGrid()
    {
        for ($i = 0; $i < $this->dimY; $i++) {
            $this->grid[] = [];
            for ($j = 0; $j < $this->dimX; $j++) {
                $this->grid[$i][] = 0;
            }
        }
    }

    /**
     * Return the given row
     *
     * @param   $rowNumber
     * @return  array
     */
    public function getRow($rowNumber)
    {
        return $this->grid[$rowNumber];
    }
}
