<?php

namespace App\Traits;

trait ApiTrait
{
    /**
     * Send API output.
     *
     * @param  mixed  $data
     * @param  int  $status
     */
    protected function sendOutput(mixed $data, int $status)
    {
        header_remove('Set-Cookie');
        header('Content-Type: application/json');

        switch ($status){
            case 200:
                header( 'HTTP/1.1 200 OK');
                break;
            case 400:
                header( 'HTTP/1.1 400 Bad Request');
                break;
            case 404:
                header( 'HTTP/1.1 404 Not Found');
                break;
        }

        echo $data;
        exit;
    }
}