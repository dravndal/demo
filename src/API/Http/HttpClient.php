<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Http;

use Danielr\Demo\API\Contracts\HttpClientInterface;
use Danielr\Demo\API\Exceptions\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient implements HttpClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => 'danielcravndal@gmail.com',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function get(string $uri, array $headers = []): array
    {
        try {
            $response = $this->client->get($uri, ['headers' => $headers]);
            return json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR);
        } catch (GuzzleException $e) {
            throw new HttpException('GET request failed: ' . $e->getMessage(), $e->getCode());
        } catch (\JsonException $e) {
            throw new HttpException('Invalid JSON response');
        }
    }

    public function post(string $uri, array $data = [], array $headers = []): array
    {
        try {
            $response = $this->client->post($uri, [
                'headers' => $headers,
                'json' => $data
            ]);
            return json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR);
        } catch (GuzzleException $e) {
            throw new HttpException('POST request failed: ' . $e->getMessage(), $e->getCode());
        } catch (\JsonException $e) {
            throw new HttpException('Invalid JSON response');
        }
    }
}
