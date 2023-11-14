<?php

return [
    'api' => [
        'url' => env('POKE_API_URL', 'https://beta.pokeapi.co/graphql/v1beta'),
        'headers' => [
            'Content-Type'  => 'application/json',
            'X-Method-Used' => 'graphiql'
        ]
    ],
    'cache' => [
        'ttl' => env('POKEMON_CACHE_TTL', 216000) // 1hr default
    ]
];
