<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use Illuminate\Http\JsonResponse;
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
    public function __construct(private Ar24apiClient $client, private int $user_id = 0,  private string $date = '')
    {
        $date =  $this->date = now()->tz('Europe/Paris')->format('Y-m-d H:i:s');
    }


     /**
     * Upload file img to the designated folder
     *
     * @return JsonResponse|string
     */
    public function uploadAttachment(Request $request, ): JsonResponse|string
    {
        if(empty($request->attachment)) return response()->json([
            'message' => 'You must choose a file before upload',
        ]);

        $file = $request->attachment;
        $file_name = Str::before($file->getClientOriginalName(), '.'.$file->extension());
        
        /**
         * Validation file
         */
        if($file->isValid()){
            Validator::validate($request->all(), [
                'attachment' => ['required', File::document()->between(1,256000 )],
            ]);
        }
       
        try{
            $r = 
            $this->client->buildRequest($this->date, 'multipart')
            ->attach('file', \file_get_contents($file), $file->getClientOriginalName() )
            ->post('attachment/', [
                'token' => $this->client->getClientSecret(),
                'date'  => $this->date,
                'file_name' => $file_name,
                'id_user' => $request->user_id,
            ])->body();

            if( is_string($r) && \is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return response()->json([
                    'message' => json_decode($r, true)['message']
                ]);
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
     * @return JsonResponse|string
     */
    private function returnResponse(array $response): JsonResponse|string
    {

        return match ($response['status']) {
            'SUCCESS' =>  response()->json([
                'message' => 'The file has been sent !',
            ]),
            'ERROR' =>  response()->json([
                'message' => ' something went wrong in the upload.',
            ]),
            default =>  response()->json([
                'message' => 'Something went wrong...',
            ]),
        };      

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
