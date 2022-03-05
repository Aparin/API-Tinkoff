<?php

function bubble_sort($arr)
{
    $size = count($arr) - 1;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size - $i; $j++) {
            $k = $j + 1;
            if ($arr[$k]->value < $arr[$j]->value) {
                // Swap elements at indices: $j, $k
                list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
            }
        }
    }
    return $arr;
}


class Obj
{
    public $value, $content;
    public function __construct($value, $content)
    {
        $this->value = $value;
        $this->content = $content;
    }
}

$max = new Obj($value = 10, $content = "maximum");
$min = new Obj($value = 0, $content = "minimum");
$average = new Obj($value = 5, $content = "среднее");

$arr = [];
array_push($arr, $max, $min, $average);
echo $arr[0]->value;

echo "<pre>";
print("Before");
print_r($arr);
$arr = bubble_sort($arr);
echo "<br />";
print("After");
print_r($arr);
echo "</pre>";
