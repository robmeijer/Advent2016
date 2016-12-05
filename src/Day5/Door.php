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
        for ($i = 0; $i <= PHP_INT_MAX; $i++) {
            $hash = md5($id . $i);

            if (
                $this->hashVerified($hash) &&
                $this->updatePassword($hash, $withPosition)
            ) {
                if (sizeof($this->password) === 8) {
                    break;
                }
            }
        }
    }

    /**
     * @return  string
     */
    public function getPassword()
    {
        ksort($this->password);

        return implode('', $this->password);
    }

    /**
     * @param   string  $hash
     * @return  bool
     */
    private function hashVerified($hash)
    {
        return preg_match('#^00000#', $hash);
    }

    /**
     * @param   string  $hash
     * @param   bool    $withPosition
     * @return  bool
     */
    private function updatePassword($hash, $withPosition)
    {
        if ($withPosition) {
            $pos = $this->getPasswordPos($hash);
            if (! $this->positionIsValid($pos)) {
                return false;
            }

            $this->password[$pos] = $this->getPasswordChar($hash, 6);
            return true;
        }

        $this->password[] = $this->getPasswordChar($hash);
        return true;
    }

    /**
     * @param   string  $hash
     * @return  string
     */
    private function getPasswordPos($hash)
    {
        return substr($hash, 5, 1);
    }

    /**
     * @param   string  $pos
     * @return  bool
     */
    private function positionIsValid($pos)
    {
        return is_numeric($pos) && ($pos > 0 && $pos < 7) && ! isset($this->password[$pos]);
    }

    /**
     * @param   string  $hash
     * @param   int     $charPosition
     * @return  string
     */
    private function getPasswordChar($hash, $charPosition = 5)
    {
        return substr($hash, $charPosition, 1);
    }
}
