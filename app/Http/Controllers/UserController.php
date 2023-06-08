<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Services\Ar24apiClient;
use Illuminate\Http\RedirectResponse;
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
    public function __construct(private Ar24apiClient $client, private int $user_id = 0)
    {
        //
    }

    /**
     * Display a listing of the resource.
     * 
     * @return Response|string
     */
    public function index(): Response|string
    {

       try{
            $r = $this->client->buildRequest()->get('user/list', $this->client->formData())->body();

            $decrypted_response = $this->client->decryptResponse($r);

            $response = json_decode($decrypted_response, true);
            
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
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse|string
    {
        $request->validated();

        $form_data =  $this->client->formData($request->validated());

        try{
            $r = $this->client->buildRequest()->post('user',  $form_data )->body();
            
            $decrypted_response = $this->client->decryptResponse($r);
            $response = json_decode($decrypted_response, true);
    
            if( is_string($r) && is_array(json_decode($r, true)) && json_decode($r, true)['status'] === 'ERROR'){
                return $this->redirectWithFlashMessage('user.create',json_decode($r, true)['message'], 'danger' );
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
            'SUCCESS' => $this->redirectWithFlashMessage('user.create', 'The user has been created!'),
            'ERROR' =>  $this->redirectWithFlashMessage('user.create',  $response['message'], 'danger'),
            default =>  $this->redirectWithFlashMessage('user.create',  'something went wrong ...', 'danger'),
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
     * Display the specified resource.
     *
     * @param int $id
     * @return Inertia\Response|string
     */
    public function show(int $id): Response|string
    {
        try{
            $r = $this->client->buildRequest()->get('user', $this->client->formData(['id_user' => $id]))->body();

            $decrypted_response = $this->client->decryptResponse($r);

            $response = json_decode($decrypted_response, true);
   
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
