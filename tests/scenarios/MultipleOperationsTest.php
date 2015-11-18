<?php

namespace scenarios\Knapsack;

use Knapsack\Collection;
use PHPUnit_Framework_TestCase;

class MultipleOperationsTest extends PHPUnit_Framework_TestCase
{
    public function testIt()
    {
        $array = [1, 2, 8, 3, 7, 5, 1, 4, 4,];
        $collection = new Collection($array);

        $result = $collection
            ->reject(function ($v) {
                return $v > 2;
            })
            ->filter(function ($k) {
                return $k > 5;
            })
            ->distinct()
            ->concat([1, 2])
            ->map(function ($i) {
                return [$i, $i + 1];
            })
            ->flatten()
            ->sort(function ($a, $b) {
                return $a > $b;
            })
            ->slice(2, 5)
            ->groupBy(function ($v) {
                return $v % 2 == 0 ? 'even' : 'odd';
            })
            ->get('even');

        $this->assertEquals([2], $result);
    }
}