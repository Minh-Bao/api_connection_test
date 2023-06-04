<?php

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class Ar24apiClient
{
    private string $prefixCache = "ar24_api";
    private string $date;
    private string $signature;
    private  File $file;

    public function __construct()
    {
        //
    }

    /**
     * Return the base uri
     * @throws Throwable
     * @return string
     */
    private function getBaseUri(): string
    {
        $baseUri = \config('api.ar24.base_uri');
        \throw_if(
            !\is_string($baseUri),
            Exception::class,
            'Le fichier de config ne renvoi rien ou un autre type que string'
        );

        return $baseUri;
    }

     /**
     * Return la clé de déchiffrrement
     * @throws Throwable
     * @return string
     */
    private function getPrivateKey(): string
    {
        $baseUri = \config('api.ar24.private_key');
        \throw_if(
            !\is_string($baseUri),
            Exception::class,
            'Le fichier de config ne renvoi rien ou un autre type que string'
        );

        return $baseUri;
    }

         /**
     * Return la clé de déchiffrrement
     * @throws Throwable
     * @return string
     */
    public function getClientSecret(): string
    {
        $baseUri = \config('api.ar24.secret');
        \throw_if(
            !\is_string($baseUri),
            Exception::class,
            'Le fichier de config ne renvoi rien ou un autre type que string'
        );

        return $baseUri;
    }

    /**
     * Construct the pre request with headers
     *
     * @param string|null $type
     * @param string $date
     * @return PendingRequest
     */
    public  function buildRequest(string $date, ?string $type = 'formParam'): PendingRequest
    {
        if($type === 'multipart'){
            return $this->multipartRequest($date);
        }

        return $this->formRequest($date);
    }

    /**
     * build a pre-request as form
     *
     * @param string $date
     * @return PendingRequest
     */
    private function formRequest(string $date): PendingRequest
    {
        $this->date = $date;

        return 
        Http::maxRedirects(10)
        ->timeout(10)
        ->asForm()
        ->withHeaders([
            'signature'     => $this->getSignature(),
            'date'          => $this->date
        ])->baseUrl($this->getBaseUri());
    }

    /**
     * build a pre-request as multipart
     *
     * @param string $date
     * @return PendingRequest
     */
    private function multipartRequest(string $date): PendingRequest
    {
        $this->date = $date;

        return 
        Http::maxRedirects(10)
        ->timeout(10)
        ->asMultipart()
        ->withHeaders([
            'signature'     => $this->getSignature(),
            'date'          => $this->date
        ])->baseUrl($this->getBaseUri());
    }

    /**
     * Return signature of the request
     *
     * @return string
     */
    private function getSignature(): string
    {
        $private_key = $this->getPrivateKey();

        $hashed_private_key = hash('sha256', $private_key);

        // Initialization Vector : First 16 bytes of 2 times hashed private key
        $iv = mb_strcut(hash('sha256', $hashed_private_key), 0, 16, 'UTF-8');

        $this->signature = openssl_encrypt($this->date, 'aes-256-cbc', $hashed_private_key, false, $iv);
        
        return $this->signature;
    }


    /**
     * Decrypt the answer of the request
     *
     * @param string $response
     * @return string|false
     */
    public function decryptResponse(string $response): false|string
    {
        $encrypted_response = $response;
        $receivedate = $this->date; /* Same value as the date given when calling our service */
        $private_key = config('api.ar24.private_key');
        $key = hash('sha256', $receivedate.$private_key);

        // Initialization Vector : First 16 bytes of 2 times hashed private key
        $iv = mb_strcut(hash('sha256', hash('sha256', $private_key)), 0, 16, 'UTF-8');

        return openssl_decrypt($encrypted_response, 'aes-256-cbc', $key, false, $iv); 

    }
}