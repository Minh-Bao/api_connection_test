<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use App\Http\Requests\StoreMailRequest;
use Illuminate\Http\RedirectResponse;

class Mailcontroller extends Controller
{
     /**
     * Constructor of the class
     *
     * @param Ar24apiClient $client
     * @param string $date
     */
    public function __construct(private Ar24apiClient $client, private string $date = '')
    {
        $date =  $this->date = now()->tz('Europe/Paris')->format('Y-m-d H:i:s');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        return Inertia::render('Users/Mails/Send', ['user_id' => $id]);
    }

    /**
     * Undocumented function
     *
     */
    public function send(StoreMailRequest $request)
    {
        $request->validated();

        try{
            $r = $this->client->buildRequest($this->date)->post('user', [
                'token' => $this->client->getClientSecret(),
                'date'  => $this->date,
                'eidas' => 0,
                'custom_name_sender' => $request->custom_name_sender ,     
                'to_lastname' => $request->to_lastname ,
                'to_firstname' => $request->to_firstname ,
                'to_company' => $request->address2 ,
                'to_email' => $request->statut ,
                'dest_statut' => $request->company ,
                'content' => $request->city ,
                'ref_dossier' => $request->zipcode ,
                'attachment' => $request->gender ,
            ])->body();
            
            $decryptedResponse = $this->client->decryptResponse($r);
            $response = json_decode($decryptedResponse, true);
    
            if( is_string($r) && is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return $this->redirectWithFlashMessage('user.mail.send',json_decode($r, true)['message'], 'danger' );
            }

            return $this->returnResponse($response);   

        }catch(Exception $e){
            return $e->getMessage();
        }   
     }

     /**
     * returning the response
     *
     * @param array $response
     * @return RedirectResponse|string
     */
    private function returnResponse(array $response): RedirectResponse|string
    {
        return match ($response['status']) {
            'SUCCESS' => $this->redirectWithFlashMessage('user.mail.send', 'The file has been sent !'),
            'ERROR' =>  $this->redirectWithFlashMessage('user.mail.send',  'something went wrong in the upload.', 'danger'),
            default =>  $this->redirectWithFlashMessage('user.mail.send',  'something went wrong ...', 'danger'),
        };     

    }

     /**
     * Redirect to route with a flash message
     *
     * @param string $route
     * @param string $message
     * @param string $type
     * @return RedirectResponse
     */
    private function redirectWithFlashMessage(string $route, string $message, ?string $type = "success"): RedirectResponse
    {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);         
        return \to_route($route);
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
