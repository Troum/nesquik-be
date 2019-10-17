<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'address',
        'game_code'
    ];

    public function store($request)
    {
        $this->name = $request->name;
        $this->code = $request->code;
        $this->phone = $request->phone;
        $this->email = $request->email;
        $this->address = $request->address;
        $this->save();
    }
}
