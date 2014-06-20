<?php

/**
 * A collection of SampleItem's
 */
class SampleItemCollection implements \IteratorAggregate
{
    protected $items;

    /**
     * @param SampleItem[] $items
     */
    function __construct(array $items = [])
    {
        $this->items = $items;
    }

    // Required -
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Get a SampleItem by its ID
     *
     * @param $id
     * @return SampleItem|null
     */
    public function getItemById($id) {
        foreach ($this->items as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Return the number of SampleItem's in this collection
     *
     * @return int
     */
    public function count() {
        return count($this->items);
    }

    /**
     * Add a SampleItem to the collection
     *
     * @param SampleItem $item
     */
    public function addItem(SampleItem $item)
    {
        $this->items[] = $item;
    }
}
