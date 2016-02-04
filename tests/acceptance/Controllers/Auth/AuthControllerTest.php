<?php
/**
 * AuthControllerTest.php
 * Copyright (C) 2016 Sander Dorigo
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-19 at 15:40:28.
 */
class AuthControllerTest extends TestCase
{

    /**
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::logout
     */
    public function testLogout()
    {
        $this->be($this->user());
        $this->call('GET', '/logout');
        $this->assertResponseStatus(302);

        // index should now redirect:
        $this->call('GET', '/');
        $this->assertResponseStatus(302);
    }

    /**
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::login
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::__construct
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::sendFailedLoginResponse
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::getFailedLoginMessage
     *
     */
    public function testLogin()
    {
        $args     = [
            'email'    => 'thegrumpydictator@gmail.com',
            'password' => 'james',
            'remember' => 1,
        ];
        $this->call('POST', '/login', $args);
        $this->assertResponseStatus(302);

        $this->call('GET', '/');
        $this->assertResponseStatus(200);


    }

    /**
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::register
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::create
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::isBlockedDomain
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::getBlockedDomains
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::validator
     */
    public function testRegister()
    {
        $args     = [
            'email'                 => 'thegrumpydictator+test@gmail.com',
            'password'              => 'james123',
            'password_confirmation' => 'james123',
        ];
        $this->call('POST', '/register', $args);
        $this->assertResponseStatus(302);
        $this->assertSessionHas('start');
    }

    /**
     * @covers FireflyIII\Http\Controllers\Auth\AuthController::showRegistrationForm
     */
    public function testShowRegistrationForm()
    {
        $this->call('GET', '/register');
        $this->assertResponseStatus(200);
    }
}
