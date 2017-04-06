<?php
namespace App\Actions\Types;

interface Runner {
    public function run($triggerable);
}