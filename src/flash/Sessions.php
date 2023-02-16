<?php

namespace Cisco\Shadow\flash;
use Cisco\Shadow\Interfaces\SessionInterface;

class Sessions implements SessionInterface
{
	/**
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	public function addSession(string $key, mixed $value) {
        return $_SESSION[$key] = $value;
	}
	
	/**
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function removeSession(string $key) {
        unset($_SESSION[$key]);
	}
}
