<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
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
     * Display a listing of the resource.
     * 
     * @return Response|string
     */
    public function index(): Response|string
    {
       try{
            $r = $this->client->buildRequest($this->date)->get('user/list', [
                'token' => $this->client->getClientSecret(),
                'date'  => $this->date,
            ])->body();

            $decryptedResponse = $this->client->decryptResponse($r);

            $response = json_decode($decryptedResponse, true);
            
            $users = [];

            if( is_string($r) && is_array($response)){
                $users = $response['result']['users'];
            }

            return Inertia::render('Users/Index', [
                'users' => $users
            ]);
       }catch(Exception $e){
            return $e->getMessage();
       }

    }

    /**
     * Show the form to create a new resource.
     * 
     * @return Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {

        $request->validated();

        try{
            $r = $this->client->buildRequest($this->date)->post('user', [
                'token' => $this->client->getClientSecret(),
                'date'  => $this->date,
                'firstname' => $request->firstname ,
                'lastname' => $request->lastname ,
                'email' => $request->email ,
                'address1' => $request->address1 ,
                'address2' => $request->address2 ,
                'statut' => $request->statut ,
                'company' => $request->company ,
                'city' => $request->city ,
                'zipcode' => $request->zipcode ,
                'gender' => $request->gender ,
                'country'  => $request->country, 
                'password' => $request->password ,
                'company_siret' => $request->company_siret ,
                'company_tva' => $request->company_tva ,
                'confirmed' =>$request->confirmed ,
                'billing_email' => $request->billing_email ,
                'notify_ev' =>$request->notify_ev ,
                'notify_ar' => $request->notify_ar ,
                'notify_ng' =>$request->notify_ng ,
                'notify_consent' =>$request->notify_consent ,
                'notify_eidas_to_valid' =>$request->notify_eidas_to_valid ,
                'notify_recipient_update' =>$request->notify_recipient_update ,
                'notify_waiting_ar_answer' =>$request->notify_waiting_ar_answer ,
                'is_legal_entity' =>$request->is_legal_entity ,
            ])->body();
            
            $decryptedResponse = $this->client->decryptResponse($r);
            $response = json_decode($decryptedResponse, true);
    
            if( is_string($r) && is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return response()->json([
                    'message' => json_decode($r, true)['message']
                ]);
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
     * @return JsonResponse|string
     */
    private function returnResponse(array $response): JsonResponse|string
    {

        return match ($response['status']) {
            'SUCCESS' =>  response()->json([
                'status' => 'success',
                'message' => $response['message'],
            ]),
            'ERROR' =>  response()->json([
                'status' => 'error',
                'message' => $response['message'],
            ]),
            default =>  response()->json([
                'status' => 'unkown..',
                'message' => 'Something went wrong...',
            ]),
        };      

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Inertia\Response|string
     */
    public function show(int $id): Response|string
    {
        try{
            $r = $this->client->buildRequest($this->date)->get('user', [
                'token' => $this->client->getClientSecret(),
                'date'  => $this->date,
                'id_user' => $id,
            ])->body();

            $decryptedResponse = $this->client->decryptResponse($r);

            $response = json_decode($decryptedResponse, true);
   
            return Inertia::render('Users/Show', ['user' => $response['result']]);

        }catch(Exception $e){
            return $e->getMessage();
        }
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
