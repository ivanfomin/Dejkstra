<?php

$data = json_decode(file_get_contents(__DIR__ . '/graph.json'));

//находит узел с наменьшей ценой
function find_lowest_cost_node(array $node)
{
    $lowest_cost = INF;
    $lowest_cost_node = null;
    foreach ($node as $key => $value) {
        $cost = $value;
        if ($cost < $lowest_cost) {
            $lowest_cost = $cost;
            $lowest_cost_node = $key;
        }
    }

    return $lowest_cost_node;
}

//массив шагов от указанного узла, до начала
function steps(int $number, array $parents): array
{
    $steps[1] = $number;
    while ($number != null) {
        $steps[] = $parents[$number];
        $number = $parents[$number];
    }
    $steps = array_reverse($steps);
    //первый элемент будет null, поэтому удаляем

    array_shift($steps);

    return $steps;
}

$nodes = [];
$costs = [];
$processed = [];
$parents = [];

foreach ($data as $inner) {
    $nodes[$inner[0]][$inner[1]] = $inner[2];
    $costs[$inner[0]] = INF;
    $processed[$inner[0]] = false;
}

//устанавливаем цену первым ребрам узла 1
foreach ($nodes[1] as $key => $value) {
    $costs[$key] = $value;
    $parents[$key] = 1;
}

$costs[1] = 0;
$costs[] = INF;
$nodes[] = null;
$processed[1] = true;

//кол-во вызовов ф-ции нахождения узла с наименьшим ребром
$count = 1;
$node = find_lowest_cost_node($nodes[1]);

while ($node !== null) {
//если дошдли до конца, ищем не обработанные узлы
    if ($nodes[$node] === null) {
        foreach ($processed as $key => $value) {
            if ($value === false) {
                $node = $key;
                break;
            }
        }
    }
//здесь все узлы обработаны
    if ($nodes[$node] === null) {
        break;
    }

    $neighbors = $nodes[$node];
    $cost = $costs[$node];
//проход по соседям узла
    foreach ($neighbors as $key => $neighbor) {
        $new_cost = $cost + $neighbor;
//если новая цена меньше предыдущей - онбновляем стоимость
        if ($costs[$key] > $new_cost) {
            $costs[$key] = $new_cost;
            $parents[$key] = $node;
        }
    }
    // помечаем узел как обработанный
    $processed[$node] = true;
// ищем следыущей узел с мимимальной стоимостью
    $node = find_lowest_cost_node($neighbors);
    $count++;
}

$steps = steps(count($nodes), $parents);

$steps = array_reverse($steps);

//кол-во обращений
echo $count; //в данном случае 16

//кол-во узлов
$counts = count($nodes);

//список узлов, до каждого узла
$allSteps = [];
$allSteps[1] = steps($counts, $parents);

while ($counts > 0) {
    $counts--;

    $allSteps[] = steps($counts, $parents);
}

$allSteps = array_reverse($allSteps);

foreach ($costs as $key => $value) {
    echo 'Узел ' . $key .' Стоиомсть ' . $value . ' Шаги ->' . implode(' : ', $allSteps[$key]) . "\n";
}

