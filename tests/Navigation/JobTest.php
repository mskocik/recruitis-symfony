<?php

namespace App\Tests\Navigation;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testNavigation(string $url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    /**
     * @return array<string[]>
     */
    public static function urlProvider(): array
    {
        return [
            ['/'],
            // TODO: detail page
        ];
    }
}
