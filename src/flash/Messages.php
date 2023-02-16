<?php

namespace Cisco\Shadow\flash;

use Cisco\Shadow\Interfaces\MessageInterface;

class Messages implements MessageInterface
{
    public function __construct()
    {

        $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');

        if ($is_page_refreshed) {
            $_SESSION["success_msg"] = "";
            $_SESSION["error_msg"] = "";
        } else {
            //echo 'This page is freshly visited. Not refreshed.';
        }

    }
    /**
     * @param string $msg
     * @return mixed
     */
    public function success(string $msg)
    {
        $_SESSION["success_msg"] = "";
        $_SESSION["error_msg"] = "";
        return $_SESSION["success_msg"] = $msg;
    }

    /**
     *
     * @param string $msg
     * @return mixed
     */
    public function error(string $msg)
    {
        $_SESSION["success_msg"] = "";
        $_SESSION["error_msg"] = "";
        return $_SESSION["error_msg"] = $msg;
    }
}
