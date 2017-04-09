<?php
namespace App\Actions\Types;

interface ActionType {
    public function getRunner();
}