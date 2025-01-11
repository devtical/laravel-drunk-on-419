<?php

/**
 * Test to ensure the 419 route returns a 419 status.
 */
it('has 419', function () {
    $response = $this->get('/419');

    $response->assertStatus(419);
});

/**
 * Test to ensure the 419 route with middleware redirects to the previous page.
 */
it('redirects to the previous page', function () {
    $previousUrl = '/login';
    $response = $this->get('/419-redirect');

    $response->assertRedirect($previousUrl);
});
