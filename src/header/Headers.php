<?php

namespace Cisco\Shadow\header;

class Headers
{
    static function getStatusMessage(int $statusCode){
        switch ($statusCode) {
            case 200:
                return "200 success";
            case 201:
                return "201 created";
            case 202:
                return "202 accepted";
            case 400:
                return "400 bad request";
            case 404:
                return "404 not found";
            case 401:
                return "401 unAuthorized";
            case 402:
                return "402 payment required";
            case 403:
                return "403 forbiden";
            case 405:
                return "405 method not allowed";
            case 406:
                return "405 not acceptable";
            case 407:
                return "407 Proxy Authentication Required";
            case 408:
                return "408 Request Timeout";
            case 409:
                return "409 Conflit";
            case 410:
                return "410 Gone";
            case 500:
                return "500 Internal error";
            case 501:
                return "501 Not implemented";
            default:
                # code...
                break;
        }
    }
}
