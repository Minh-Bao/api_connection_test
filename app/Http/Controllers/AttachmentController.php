<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class AttachmentController extends Controller
{

     /**
     * Constructor of the class
     *
     * @param Ar24apiClient $client
     * @param integer $user_id
     * @param string $date
     */
    public function __construct(private Ar24apiClient $client, private int $user_id = 0)
    {
        //
    }


     /**
     * Upload file img to the designated folder
     *
     * @return RedirectResponse|JsonResponse|string
     */
    public function uploadAttachment(Request $request, ): RedirectResponse|JsonResponse|string
    {
        if(empty($request->attachment)) return $this->redirectWithFlashMessage('user.index','You must choose a file before upload !!!!', 'danger');

        $file = $request->attachment;
        $file_name = Str::before($file->getClientOriginalName(), '.'.$file->extension());
        
        /**
         * Validation file
         */
        if($file->isValid()){
            $validation = Validator::validate($request->all(), [
                'attachment' => ['required', File::document()->between(1,256000 )],
            ]);
        }

        $formData = $this->client->formData([ 'file_name' => $file_name, 'id_user' => $request->user_id,]);
       
        try{
            $r = 
            $this->client->buildRequest('multipart')
            ->attach('file', \file_get_contents($file), $file->getClientOriginalName() )
            ->post('attachment/',$formData)->body();

            if( is_string($r) && \is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return $this->redirectWithFlashMessage('user.index',json_decode($r, true)['message'], 'danger' );
            }

            $decryptedResponse = $this->client->decryptResponse($r);
            $response = json_decode($decryptedResponse, true);
            
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
            'SUCCESS' => $this->redirectWithFlashMessage('user.index', 'The file has been sent !'),
            'ERROR' =>  $this->redirectWithFlashMessage('user.index',  'something went wrong in the upload.', 'danger'),
            default =>  $this->redirectWithFlashMessage('user.index',  'something went wrong ...', 'danger'),
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
