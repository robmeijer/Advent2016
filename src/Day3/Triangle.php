<?php

namespace Advent2016\Day3;

class Triangle
{
    protected $valid = 0;

    public function validate($input, $method = 'horizontal')
    {
        preg_match_all('/\d+\s+\d+\s+\d+/', $input, $matches);

        $rc = 0;
        $dimensions = [];

        foreach ($matches[0] as $match) {
            preg_match('/(\d+)\s+(\d+)\s+(\d+)/', $match, $row);

            if ($method == 'horizontal') {
                $dimensions = [$row[1], $row[2], $row[3]];

                if ($this->isValid($dimensions)) {
                    $this->valid++;
                }
            } else {
                $dimensions[$rc][] = $row[1];
                $dimensions[$rc+1][] = $row[2];
                $dimensions[$rc+2][] = $row[3];
                if (count($dimensions[$rc]) == 3) {
                    if ($this->isValid($dimensions[$rc])) {
                        $this->valid++;
                    }
                    if ($this->isValid($dimensions[$rc+1])) {
                        $this->valid++;
                    }
                    if ($this->isValid($dimensions[$rc+2])) {
                        $this->valid++;
                    }

                    $rc += 3;
                }
            }
        }
    }

    private function isValid($dimensions)
    {
        if ($dimensions[0] + $dimensions[1] > $dimensions[2] &&
            $dimensions[1] + $dimensions[2] > $dimensions[0] &&
            $dimensions[2] + $dimensions[0] > $dimensions[1]
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getValid()
    {
        return $this->valid;
    }
}
