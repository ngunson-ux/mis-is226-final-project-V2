<?php
namespace App\Resources;

interface IngredientsIF
{
    public function get(?int $id = null, ?array $requestContext = null);
}

?>