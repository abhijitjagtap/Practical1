<?php

namespace App\Repository;

interface ItemRepository
{
    public function getRowColumn();
    public function addRowColumn($collection);
    public function addItem($collection);
}
