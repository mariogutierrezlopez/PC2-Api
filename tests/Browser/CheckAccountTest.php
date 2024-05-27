<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CheckAccountTest extends DuskTestCase
{
    /**
     * Test to check if an account exists.
     *
     * @return void
     */
    public function testCheckAccount()
    {
        $credentials = json_decode(file_get_contents(base_path('tests/Browser/credentials.json')), true);
        $email = $credentials['email'];
        $password = $credentials['password'];

        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit('https://mister.mundodeportivo.com/new-onboarding/auth/email')
                    ->waitFor('#didomi-notice-agree-button', 10)
                    ->click('#didomi-notice-agree-button')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Continuar')
                    ->waitForLocation('/')
                    ->assertPathIsNot('/new-onboarding/auth/email');
        });
    }
}
