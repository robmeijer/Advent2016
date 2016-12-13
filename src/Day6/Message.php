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
            foreach ($lines as $line) {
                $chars[$i][str_split($line)[$i]] = isset($chars[$i][str_split($line)[$i]]) ? $chars[$i][str_split($line)[$i]] + 1 : 1;
            }
            arsort($chars[$i]);
        }

        $message = array_map(function ($char) use ($order) {
            $keys = array_keys($char);
            return $order == 'ASC' ? end($keys) : $keys[0];
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
