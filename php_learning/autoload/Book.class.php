<?php


class Book extends Goods {
    public function getName() {
        echo "<<{$this->name}>> <br>";
    }
}
