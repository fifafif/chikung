<?php

$count = 1000000;

class A
{
    public $a = 0;
}

$aName = 'a';

$a = new A();

$array = array();
$array['a'] = 0;

$time = microtime(true);

for ($i = $count; $i >= 0; --$i)
{
    $a->$aName++;
}

echo (microtime(true) - $time) . "\n<br>";


$time = microtime(true);

for ($i = $count; $i >= 0; --$i)
{
    $array['a']++;
}

echo (microtime(true) - $time) . "\n<br>";


$time = microtime(true);

for ($i = $count; $i >= 0; --$i)
{
    $a->a++;
}

echo (microtime(true) - $time) . "\n<br>";





