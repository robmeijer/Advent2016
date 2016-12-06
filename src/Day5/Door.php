<?php

namespace Advent2016\Day5;

class Door
{
    /**
     * @var array
     */
    private $password = [];

    /**
     * @param   string  $id
     * @param   bool    $withPosition
     */
    public function generatePassword($id, $withPosition = false)
    {
        $i = 0;
        while (count($this->password) < 8) {
            $hash = md5($id . $i++);
            if ($this->hashVerified($hash)) {
                $this->updatePassword($hash, $withPosition);
            }
        }
        ksort($this->password);
    }

    /**
     * @return  string
     */
    public function getPassword()
    {
        return implode('', $this->password);
    }

    /**
     * @param   string  $hash
     * @return  bool
     */
    private function hashVerified($hash)
    {
        return strpos($hash, '00000') === 0;
    }

    /**
     * @param   string  $hash
     * @param   bool    $withPosition
     */
    private function updatePassword($hash, $withPosition)
    {
        if ($withPosition) {
            $pos = $this->getPasswordPosition($hash);
            if ($this->positionIsValid($pos)) {
                $this->password[$pos] = $this->getPasswordChar($hash, 6);
            }

            return;
        }

        $this->password[] = $this->getPasswordChar($hash);
    }

    /**
     * @param   string  $hash
     * @return  string
     */
    private function getPasswordPosition($hash)
    {
        return $hash[5];
    }

    /**
     * @param   string  $pos
     * @return  bool
     */
    private function positionIsValid($pos)
    {
        return is_numeric($pos) && ($pos >= 0 && $pos <= 7) && ! isset($this->password[$pos]);
    }

    /**
     * @param   string  $hash
     * @param   int     $charPosition
     * @return  string
     */
    private function getPasswordChar($hash, $charPosition = 5)
    {
        return $hash[$charPosition];
    }
}
