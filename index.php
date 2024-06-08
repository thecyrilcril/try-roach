<?php

declare(strict_types=1);

require './vendor/autoload.php';

use RoachPHP\Roach;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;


class RoachDocsSpider extends BasicSpider
{
    /**
     * @var string[]
     */
    public array $startUrls = [
        'https://roach-php.dev/docs/spiders'
    ];

    public function parse(Response $response): \Generator
    {
        $title = $response->filter('h1')->text();

        $subtitle = $response
            ->filter('main > div:nth-child(2) p:first-of-type')
            ->text();

        yield $this->item([
            'title' => $title,
            'subtitle' => $subtitle,
        ]);
    }
}

return Roach::startSpider(RoachDocsSpider::class);
