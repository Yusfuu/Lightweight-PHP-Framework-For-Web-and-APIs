<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Users;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public function index(Request $request)
  {
    $users = Users::all();
    Response::json($users);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public function store(Request $request)
  {
    Users::create($request->json());
  }

  /**
   * Display the specified resource.
   *
   * @param  \Http\Request  $request
   */
  public function show(Request $request)
  {
    $user = Users::find($request->params->id);
    Response::json($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public function update(Request $request)
  {
    Users::update($request->input(), $request->params->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public function destroy(Request $request)
  {
    Users::delete($request->params->id);
  }
}
