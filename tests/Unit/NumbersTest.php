<?php

namespace Tests\Unit;

use App\User;
use Response;
use Tests\TestCase;

class NumbersTest extends TestCase
{

    function setup() {
        parent::setup();
        $user = new User(['email' => 'user@domain.com', 'demo12']);
        $this->be($user);
    }

    public function testIsValidLongNumberTest()
    {
        $response = $this->get('/check/27823096710');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'success',
                'correction' => 'number correct'
            ]);
    }

    public function testIsValidStrippedNumberTest()
    {
        $response = $this->get('/check/823096710');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'success',
                'correction' => 'added country code'
            ]);
    }

    public function testIsValidShortNumberTest()
    {
        $response = $this->get('/check/0823096710');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'success',
                'correction' => 'added country code and removed 0'
            ]);
    }

    public function testIsDeletedNumberTest() {
        $response = $this->get('/check/27836826107_DELETED_1488996550');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'warning',
                'correction' => 'stripped deleted',
            ]);

    }

    public function testInvalidPrefixTest() {
        $response = $this->get('/check/27866826107');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'error',
                'correction' => 'failed prefix check',
            ]);

    }

    public function testIsInvalidNumberTest()
    {
        $response = $this->get('/check/08230967101');
        $response
            ->assertStatus(200)
            ->assertJson([
                'state' => 'error',
                'correction' => 'invalid mobile number',
            ]);
    }

}
