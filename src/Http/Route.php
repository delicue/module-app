<?php 

namespace App\Http;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route {
    public string $method;
    public string $uri;

    public function __construct(string $method, string $uri) {
        $this->method = $method;
        $this->uri = $uri;
    }
}