<?php

namespace Cisco\Shadow\Interfaces;

interface SessionInterface
{
    function addSession(string $key,mixed $value);
    function removeSession(string $key);
}
