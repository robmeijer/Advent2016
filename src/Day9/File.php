<?php

namespace Advent2016\Day9;

use League\Flysystem\FilesystemInterface;

class File
{
    /**
     * @var string
     */
    protected $contents;

    /**
     * Decompressed content length
     *
     * @var int
     */
    protected $length = 0;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * File constructor.
     *
     * @param   FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Import file contents
     *
     * @param   $file
     */
    public function import($file)
    {
        $this->contents = $this->filesystem->read($file);
    }

    /**
     * @return  string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Decompress file contents
     *
     * @param   bool    $recursive
     */
    public function decompress($recursive = false)
    {
        $this->decompressText($this->getContents(), $recursive);
    }

    /**
     * Decompressed given text
     *
     * @param   string  $text
     * @param   bool    $recursive
     */
    private function decompressText($text, $recursive = false)
    {
        preg_match('#(?<pre>\w*)\((?<instruction>\d+x\d+)\)(?<post>.*)#', $text, $matches);
        if (empty($matches)) {
            $this->length += strlen($text);
            return;
        }

        $this->length += strlen($matches['pre']);

        $instruction = $matches['instruction'];
        list($numChars, $repeated) = explode('x', $instruction);

        preg_match('#(?<target>^.{' . $numChars . '})(?<post>.*)#', $matches['post'], $matches);
        for ($i = 0; $i < $repeated; $i++) {
            if ($recursive) {
                $this->decompressText($matches['target'], $recursive);
            } else {
                $this->length += strlen($matches['target']);
            }
        }

        $this->decompressText($matches['post'], $recursive);
    }

    /**
     * Return decompressed content length
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }
}
