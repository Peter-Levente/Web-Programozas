<?php

class SubjectDeleteException extends Exception
{

    public function __construct($message = "A kurzus nem törölhető, mert vannak hozzá rendelve hallgatók.")
    {
        parent::__construct($message);
    }
}