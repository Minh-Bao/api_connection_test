<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

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
    public function send()
    {

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
