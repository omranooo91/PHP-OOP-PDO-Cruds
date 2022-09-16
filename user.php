<?php

class User
{
    public $id;
    public $name;
    public $age;
    public $address;
    public $tax;
    public $salary;


    public function salaryCalc(){
        return $this->salary - ($this->salary * $this->tax / 100);
    }

}