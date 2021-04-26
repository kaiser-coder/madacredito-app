<?php

// use PHPUnit\Framework\TestCase;

class Admins_test extends TestCase
{
   public function test_login()
   {
		$this->assertContains('CodeIgniter', '<title>Welcome to CodeIgniter</title>');
   }
}
