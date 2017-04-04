<?php
namespace App\Actions\Types;

abstract class Runner {
    abstract public function run($triggerable);
}