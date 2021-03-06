<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterFormRequest extends Request {

  public function authorize()
  {
     return true;
  }

  public function rules()
  {
    return [
        'client_name' => 'required|regex:/^[(a-zA-Z )]+$/u',
        'contact_number' =>  'required|numeric',
        'address' => 'required',
        'email' => 'required|email',
        'event_date' => 'required',
        'event_venue' => 'required',
        'event_type' => 'required',
        'package_selected' => 'required',
        'number_of_guests' => 'required|numeric',
        'mode_payment' => 'required',
        'advance' => 'required|numeric',
        'balance' => 'required|numeric',
    ];
  }

}