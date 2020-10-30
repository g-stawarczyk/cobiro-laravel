<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Exception;

use Exception;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;

class ProductNotFoundException extends Exception
{
    public function __construct(Uuid $id)
    {
        parent::__construct(sprintf('Product with id `%s` not found!', $id));
    }
}
