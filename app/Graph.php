<?php

class Graph
{
    protected array $nodes;
    public static $count = 0;

    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
        $this->fillNodes();
    }

    protected function fillNodes()
    {
        //устанавливаем значения для начального узла
        $this->nodes[1]->setParent(0);
        $this->nodes[1]->setWeight(0);
        $this->nodes[1]->setProcessed(true);


        foreach ($this->nodes[1]->getNodes() as $key => $value) {
            $this->nodes[$key]->setParent(1);
        }

        $node = Worker::findLowestCostNode(1, $this->nodes);


        while ($node !== null) {
            //кол-во вызовов
            self::$count++;
            //устанавиваем родителя
            $parent = $this->nodes[$node]->getParent();
            $parent = $this->nodes[$parent];
            //проходимся по дочерним узлам, и если они не обработаны, устанавливаем им родителя текущий узел
            foreach ($this->nodes[$node]->getNodes() as $key => $value) {
                if ($this->nodes[$key]->isProcessed() === false) {
                    $this->nodes[$key]->setParent($node);
                }
            }
            $new_weight = $parent->getWeight() + $parent->getNodes()[$node];
            //если новая цена меньше, обновляем цену и родителя
            if ($new_weight < $this->nodes[$node]->getWeight()) {
                $this->nodes[$node]->setWeight($new_weight);
                $this->nodes[$node]->setParent($parent->getNumber());

            }
            $this->nodes[$node]->setProcessed(true);
            //находим следующий не обработанный узел, с наименьшей ценой ребра
            $node = Worker::findLowestCostNode($node, $this->nodes);


        }

    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

}