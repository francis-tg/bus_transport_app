<?php

namespace Cisco\Shadow\Interfaces;

interface MessageInterface
{
    function success(string $msg);
    function error(string $msg);
}
