<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.23
 * Time: 17.55
 */

declare(strict_types = 1);

namespace App\DTO;


use JsonSerializable;

abstract class BaseDTO implements JsonSerializable
{
    final public function jsonSerialize()
    {
        return $this->jsonData();
    }

    abstract protected function jsonData(): array;

}