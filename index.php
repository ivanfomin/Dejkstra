<?php
require_once __DIR__ . '/app/Node.php';
require_once __DIR__ . '/app/Worker.php';
require_once __DIR__ . '/app/Graph.php';

$data = json_decode(file_get_contents(__DIR__ . '/graph.json'));

//сначала заполняем двумерный массив из json
foreach ($data as $inner) {
    $tmp_nodes[$inner[0]][$inner[1]] = $inner[2];
}
//создаём массив объектов Node
$nodes = [];

foreach ($tmp_nodes as $key => $node) {
    $nodes[$key] = new Node();
    $nodes[$key]->setNumber($key);
    $nodes[$key]->setNodes($node);

}
//добавляем последний элемент, который никуда не узазывает fin
$nodes[] = new Node();


$graph = new Graph($nodes);
//var_dump($graph->getNodes());
//сложность
echo Graph::$count;