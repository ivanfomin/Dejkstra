<?php

class Node
{
    protected int $number;
    protected  $weight;
    protected array $nodes;
    protected int $parent;
    protected bool $processed;

    /**
     * Node constructor.
     * @param $weight
     */
    public function __construct($weight = INF, $processed = false, $nodes = [])
    {
        $this->weight = $weight;
        $this->processed = false;
        $this->nodes = $nodes;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Node
     */
    public function setNumber(int $number): Node
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return Node
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return array
     */
    public function getNodes(): ?array
    {
        return $this->nodes;
    }

    /**
     * @param array $nodes
     * @return Node
     */
    public function setNodes(array $nodes): Node
    {
        $this->nodes = $nodes;
        return $this;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     * @return Node
     */
    public function setParent(int $parent): Node
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->processed;
    }

    /**
     * @param bool $processed
     * @return Node
     */
    public function setProcessed(bool $processed): Node
    {
        $this->processed = $processed;
        return $this;
    }




}