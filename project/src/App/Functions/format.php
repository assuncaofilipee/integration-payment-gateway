<?php

namespace App\Functions;

trait format
{
    /***
     * @return false|string
     */
    public function toJson()
    {
        if (is_object($this)) {
            return json_encode(get_object_vars($this), JSON_UNESCAPED_SLASHES);
        } else if (is_array($this)) {
            return json_encode($this, JSON_UNESCAPED_SLASHES);
        }

        return false;
    }

    /***
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
