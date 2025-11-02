<?php 

namespace App\Http;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route {

    public function __construct(
        public string $uri,
        public string $method = 'GET',
        public array $data = [],
        public string $routerName = 'main') {
    }
}