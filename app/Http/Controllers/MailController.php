<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use App\Http\Requests\StoreMailRequest;
use Illuminate\Http\RedirectResponse;

class MailController extends Controller
{
     /**
     * Constructor of the class
     *
     * @param Ar24apiClient $client
     * @param string $date
     */
    public function __construct(private Ar24apiClient $client)
    {
        //
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function attachment_list()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        try{
            $r = $this->client->buildRequest()->get('user/attachment', $this->client->formData(['id_user' => $id]))->body();

            if( is_string($r) && is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return $this->redirectWithFlashMessage('user.mail.send',json_decode($r, true)['message'], 'danger' );
            }
            
            $decrypted_response = $this->client->decryptResponse($r);

            $response = json_decode($decrypted_response, true);


            // dd($response['result']['attachments']);
            $attachments = [];
            foreach($response['result']['attachments'] as $item){
                $attachments[]= $item['id_api_attachment'];
            }
   
            return Inertia::render('Users/Mails/Create', ['user_id' => $id, "attachments" => $attachments]);

        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     */
    public function send(StoreMailRequest $request , int $id)
    {

        $request->validated();

        $form_data = $this->client->formData($request->validated());
        $form_data['id_user'] = $id;
        $form_data['eidas'] = 0;


        try{
            $r = $this->client->buildRequest()->post('mail', $form_data)->body();
            
            if( is_string($r) && is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return $this->redirectWithFlashMessage('user.mail.create' ,json_decode($r, true)['message'], 'danger' , $id);
            }
            
            $decrypted_response = $this->client->decryptResponse($r);
            $response = json_decode($decrypted_response, true);


            return $this->returnResponse($response, $id);   

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
    private function returnResponse(array $response, ?int $id = 0): RedirectResponse|string
    {
        return match ($response['status']) {
            'SUCCESS' => $this->redirectWithFlashMessage('user.mail.create', $response['message']),
            'ERROR' =>  $this->redirectWithFlashMessage('user.mail.create',  $response['message'], 'danger'),
            default =>  $this->redirectWithFlashMessage('user.mail.create',  'something went wrong ...', 'danger'),
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
    private function redirectWithFlashMessage(string $route, string $message, ?string $type = "success", ?int $id = 0): RedirectResponse
    {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);         
        return \to_route($route, ['id', $id]);
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
