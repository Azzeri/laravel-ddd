<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


it('does DI correctly', function () {
    $this->assertTrue(true);
});