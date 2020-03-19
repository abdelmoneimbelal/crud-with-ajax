<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Client::all();
       return view('clients', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
            $request->validate([
                'name' =>'required|string|max:50',
                'email' =>'required|string|max:50',
                'position' =>'required|string|max:50',
                'mobile' =>'required|max:15',
            ]);

            // dd($request->name);

            $data = new Client;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->position = $request->position;
            $data->mobile = $request->mobile;
            $data->save();

            $respond['row'] = $data;
            return view('row')->with($respond);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Client::findOrfail($id);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if($request->ajax())
        {
            $request->validate([
                'name' =>'required|string|max:50',
                'email' =>'required|string|max:50',
                'position' =>'required|string|max:50',
                'mobile' =>'required|string|max:15',
            ]);

            // dd($request->name);

            $data = Client::findOrFail($request->id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->position = $request->position;
            $data->mobile = $request->mobile;
            $data->save();

            $respond['row'] = $data;
            return view('rowEdit')->with($respond);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::findOrfail($id)->delete();
        return response()->json(['success'=>'Deleted Success','id'=>$id]);
    }
}
