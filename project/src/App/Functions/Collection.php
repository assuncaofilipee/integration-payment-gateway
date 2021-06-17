<?php

namespace App\Functions;

class Collection
{
    private $items;

    /***
     * Collections constructor.
     * @param array $items
     */
    public function __construct(object $items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        }
        return $default;
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    public function first()
    {
        return array_values((array)$this->items)[0];
    }

    public function last()
    {
        return end($this->items);
    }

    /**
     * Add an item to the collection.
     *
     * @param mixed $item
     * @return $this
     */
    public function add($item)
    {
        $newCollection[] = $this->items;
        $newCollection[] = $item;
        $this->items = $newCollection;
        return $newCollection;
    }

    function where($atributo, $operador, $amount)
    {
        return array_filter($this->items, function ($item) use ($atributo, $amount, $operador) {
            if (property_exists($item, $atributo)) {
                $comparacao = "'{$item->$atributo}' $operador '$amount';";
                if (eval("return $comparacao")) {
                    return $item;
                }
            }
        });
    }

    public function toJson() {
        return $this;
    }
}
