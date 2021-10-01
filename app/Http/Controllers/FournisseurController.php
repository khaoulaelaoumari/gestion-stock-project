<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function fournisseur_list()
    {
      $pageConfigs = ['pageHeader' => false];
  
      return view('/content/apps/Fournisseur/list-fournisseur', ['pageConfigs' => $pageConfigs]);
    }
  
    // invoice preview App
    // public function fournisseur_preview()
    // {
    //   $pageConfigs = ['pageHeader' => false];
  
    //   return view('/content/apps/invoice/invoice-preview', ['pageConfigs' => $pageConfigs]);
    // }
  
    // // invoice edit App
    // public function fournisseur_edit()
    // {
    //   $pageConfigs = ['pageHeader' => false];
  
    //   return view('/content/apps/invoice/invoice-edit', ['pageConfigs' => $pageConfigs]);
    // }
  
    // invoice edit App
    public function fournisseur_add()
    {
      $pageConfigs = ['pageHeader' => false];
  
      return view('/content/apps/Fournisseur/add-fournisseur', ['pageConfigs' => $pageConfigs]);
    }
  
    // invoice print App
    // public function fournisseur_print()
    // {
    //   $pageConfigs = ['pageHeader' => false];
  
    //   return view('/content/apps/invoice/invoice-print', ['pageConfigs' => $pageConfigs]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
