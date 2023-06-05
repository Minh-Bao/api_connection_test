<?php

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class Ar24apiClient
{
    private string $prefixCache = "ar24_api";

    public function __construct(private string $date = '', private string $signature = '')
    {
        $date =  $this->date = now()->tz('Europe/Paris')->format('Y-m-d H:i:s');
        $signature = $this->getSignature();
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
    private function getClientSecret(): string
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
     * @return PendingRequest
     */
    public  function buildRequest(?string $type = 'formParam'): PendingRequest
    {
        if($type === 'multipart'){
            return $this->multipartRequest();
        }

        return $this->formRequest();
    }

    /**
     * add datas to hte form parameters
     *
     * @param array $newFormData
     * @return array
     */
    public function formData(array $newFormData = []): array
    {
        $formData = ['token' => $this->getClientSecret(), 'date' => $this->date ];

        return array_merge($formData, $newFormData);
    }

    /**
     * build a pre-request as form
     *

     * @return PendingRequest
     */
    private function formRequest(): PendingRequest
    {
        return 
        Http::maxRedirects(10)
        ->timeout(10)
        ->asForm()
        ->withHeaders([
            'signature'     => $this->signature,
            'date'          => $this->date
        ])->baseUrl($this->getBaseUri());
    }

    /**
     * build a pre-request as multipart
     *
     * @return PendingRequest
     */
    private function multipartRequest(): PendingRequest
    {
        return 
        Http::maxRedirects(10)
        ->timeout(10)
        ->asMultipart()
        ->withHeaders([
            'signature'     => $this->signature,
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