<?php

class ArrayManipulator
{
    private $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function __get($name)
    {
        if ($name === "data") {
            return $this->data;
        } else {
            echo "A(z) $name nevű tulajdonság nem létezik.";
        }
    }

    public function __set($name, $value)
    {
        if ($name === "data" && is_array($value)) {
            $this->data = $value;
        } else {
            echo "A(z) '$name' nevű tulajdonság nem létezik, vagy rossz típust adtál meg.";
        }
    }

    public function __isset($name)
    {
        if ($name === 'data') {
            return isset($this->data);
        }
        return false;
    }

    public function __unset($name)
    {
        if ($name === 'data') {
            unset($this->data);
        }
    }

    public function __toString()
    {
        return implode(", ", $this->data);
    }

    public function __clone()
    {
        $this->data = array_merge([], $this->data);
    }
}

?>