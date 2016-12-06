<?php

namespace Advent2016\Day6;

use League\Flysystem\FilesystemInterface;

class Message
{
    /**
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * Message constructor.
     *
     * @param   FilesystemInterface  $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Decode given file
     *
     * @param   string  $file
     * @param   string  $order
     * @return  string
     */
    public function decode($file, $order = 'DESC')
    {
        $lines = $this->getLines($this->filesystem->read($file));

        $chars = [];
        for ($i = 0; $i < strlen($lines[0]); $i++) {
            $chars[$i] = [];
            foreach ($lines as $line) {
                $lineChars = str_split($line);
                $lineChar = $lineChars[$i];
                $chars[$i][$lineChar] = isset($chars[$i][$lineChar]) ? $chars[$i][$lineChar] + 1 : 1;
            }
        }

        $message = array_map(function ($char) use ($order) {
            if ($order == 'ASC') {
                asort($char);
            } else {
                arsort($char);
            }
            return array_keys($char)[0];
        }, $chars);

        return implode('', $message);
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
}
