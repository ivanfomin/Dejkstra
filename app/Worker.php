<?php

/*
 *param Node $node
 *
 */
class Worker
{
    public static function findLowestCostNode($number, array $allNodes) : ?int

    {
        $lowest_cost = INF;
        $lowest_node = null;
        $nodes = $allNodes[$number]->getNodes();
        //если дошли до последнего узла, ищем не первый не обработанный
        if (empty($nodes)) {
            foreach ($allNodes as $find) {
                if (!$find->isProcessed()) {
                    return $find->getNumber();
                }
            }
            return null;
        }
        foreach ($nodes as $key => $tmp) {

            if ($lowest_cost > $tmp) {
                $lowest_cost = $tmp;
                $lowest_node = $key;
            }
        }
        return $lowest_node;
    }



}