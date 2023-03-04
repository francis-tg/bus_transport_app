<?php

namespace Cisco\Shadow;

class Page
{
    // public static function view(string $view)
    // {
    //     $get_handler = explode('.', $view);
    //     if (is_array($get_handler)) {
    //         $scan_page = scandir('./views/'.$get_handler[1]);
    //         if (in_array($get_handler[0].'.php', $scan_page)) {
    //             return require_once './views/'.$get_handler[0].DIRECTORY_SEPARATOR.end($get_handler).'.php';
    //         } else {
    //             return require_once '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'404.php';
    //         }
    //     } else {
    //         return require_once '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'404.php';
    //     }
    // }

    /**
     * view.
     *
     * @param string view
     *
     * @return void
     */
    public static function view(string $view)
    {
        if (self::viewContainDirectory($view, '/')) {
            $separate_file_to_dir = explode('/', $view);
            if (in_array($separate_file_to_dir[1].'.php', $separate_file_to_dir)) {
                return require '..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$separate_file_to_dir[0].DIRECTORY_SEPARATOR.$separate_file_to_dir[1].'.php';
            } else {
                return require_once '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'404.php';
            }
        } else {
            return require '..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$view.'.php';
        }
    }

    /**
     * viewContainDirectory.
     *
     * @param string view
     * @param string dirSeparator
     */
    private static function viewContainDirectory(string $view, string $dirSeparator): bool
    {
        return strpos(PHP_VERSION, '8.') ? str_contains($view, $dirSeparator) : strpos($view, $dirSeparator);
    }
}
