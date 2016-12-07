<?php

namespace Advent2016\Day7;

use League\Flysystem\FilesystemInterface;

class Address
{
    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var array
     */
    protected $addresses = [];

    /**
     * Address constructor.
     *
     * @param   FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Verify which addresses support TLS
     *
     * @param   string  $file
     */
    public function verifyTLS($file)
    {
        $this->addresses = array_filter($this->getLines($this->filesystem->read($file)), function ($line) {
            return $this->validTLSAddress($line);
        });
    }

    /**
     * Verify which addresses support SSL
     *
     * @param   string  $file
     */
    public function verifySSL($file)
    {
        $this->addresses = array_filter($this->getLines($this->filesystem->read($file)), function ($line) {
            return $this->validSSLAddress($line);
        });
    }

    /**
     * @return  array
     */
    public function getAddresses()
    {
        return $this->addresses;
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
     * Check whether given line is a valid TLS address
     *
     * @param   string  $line
     * @return  bool
     */
    private function validTLSAddress($line)
    {
        preg_match_all('/\[(\w+)\]/', $line, $matches);

        foreach ($matches[1] as $match) {
            if ($this->verifyTLSMatch(str_split($match))) {
                return false;
            }
        }

        preg_match_all('/\](\w+)\[*/', $line, $matches1);
        preg_match_all('/\]*(\w+)\[+/', $line, $matches2);

        foreach (array_merge($matches1[1], $matches2[1]) as $match) {
            if ($this->verifyTLSMatch(str_split($match))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check whether given set of characters contain pattern
     *
     * @param   array  $set
     * @return  bool
     */
    private function verifyTLSMatch($set)
    {
        foreach ($set as $key => $char) {
            if (
                $key > 1 &&
                isset($set[$key+1]) &&
                $char === $set[$key-1] &&
                $set[$key-2] === $set[$key+1] &&
                $set[$key-2] !== $set[$key-1]
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check whether given line is a valid SSL address
     *
     * @param   string  $line
     * @return  bool
     */
    private function validSSLAddress($line)
    {
        preg_match_all('/\[(\w+)\]/', $line, $matches);

        foreach ($matches[1] as $match) {
            if ($bMatches = $this->verifySSLBracketMatch(str_split($match))) {
                preg_match_all('/\](\w+)\[*/', $line, $nMatches1);
                preg_match_all('/\]*(\w+)\[+/', $line, $nMatches2);

                foreach (array_merge($nMatches1[1], $nMatches2[1]) as $nMatch) {
                    foreach ($bMatches as $bMatch) {
                        if (strpos($nMatch, $bMatch) || strpos($nMatch, $bMatch) === 0) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check whether given set of characters contain pattern
     *
     * @param   array   $set
     * @return  array|bool
     */
    private function verifySSLBracketMatch($set)
    {
        $ssls = [];
        foreach ($set as $key => $char) {
            if (
                $key > 1 &&
                $char === $set[$key-2] &&
                $char !== $set[$key-1]
            ) {
                $ssls[] = $set[$key-1] . $char . $set[$key-1];
            }
        }

        return empty($ssls) ? false : $ssls;
    }
}
