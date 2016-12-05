<?php

namespace Advent2016\Day4;

use League\Flysystem\FilesystemInterface;

class Room
{
    /**
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var int
     */
    protected $sum = 0;

    /**
     * @var string
     */
    protected $room;


    /**
     * Room constructor.
     *
     * @param   FilesystemInterface  $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Process given file
     *
     * @param   string  $file
     */
    public function process($file)
    {
        $lines = $this->getLines($this->filesystem->read($file));

        foreach ($lines as $line) {
            preg_match('/(.+)-(\d+)\[(\w+)\]/', $line, $matches);
            list($line, $name, $id, $checksum) = $matches;

            if ($this->matchesChecksum($name, $checksum)) {
                $this->sum = $this->sum + $id;
                $room = $this->decryptRoom($name, $id);
                if (strpos($room, 'pole') > 0) {
                    $this->room = $id . '. ' . $room;
                }
            }
        }
    }

    private function matchesChecksum($name, $checksum)
    {
        $chars = [];
        foreach (str_split(str_replace('-', '', $name)) as $char) {
            $chars[$char] = isset($chars[$char]) ? $chars[$char] + 1 : 1;
        }

        $test = array_map(function ($key, $value) {
            return $key . ':' . $value;
        }, array_keys($chars), $chars);

        usort($test, function ($a, $b) {
            preg_match('/([a-z]+):(\d+)/', $a, $match1);
            preg_match('/([a-z]+):(\d+)/', $b, $match2);

            if ($match1[2] == $match2[2]) {
                return $match1[1] < $match2[1] ? -1 : 1;
            }

            return $match1[2] > $match2[2] ? -1 : 1;
        });

        $keys = array_slice($test, 0, 5);

        $check = '';
        foreach ($keys as $key) {
            $check .= substr($key, 0, strpos($key, ':'));
        }

        return $check == $checksum;
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
     * Total of IDs of valid rooms
     *
     * @return int
     */
    public function getSum()
    {
        return $this->sum;
    }

    private function decryptRoom($name, $id)
    {
        $room = [];
        foreach (explode('-', $name) as $word) {
            $room[] = $this->shift($word, $id);
        }

        return implode(' ', $room);
    }

    private function shift($string, $distance)
    {
        $distance = $distance % 26;
        $string = strtolower($string);
        $result = [];
        $characters = str_split($string);

        if ($distance < 0) {
            $distance += 26;
        }

        foreach ($characters as $idx => $char) {
            $result[$idx] = chr(97 + (ord($char) - 97 + $distance) % 26);
        }

        return join('', $result);
    }

    /**
     * @return  string
     */
    public function getRoom()
    {
        return $this->room;
    }
}
