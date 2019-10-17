<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Code;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodeMail;

trait System
{
    /**
     * @param $code
     * @return bool
     */
    protected function check($code)
    {
        $code = Code::whereCode($code)->firstOrFail();

        if ($code->status) {
            $code->update([
                'status' => false
            ]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function generate($id)
    {
        if ($id < 10) {
            return '0000' . $id;
        }
        if ($id > 9 && $id < 100) {
            return '000' . $id;
        }
        if ($id > 99 && $id < 1000) {
            return '00' . $id;
        }
        if ($id > 999 && $id < 10000) {
            return '0' . $id;
        }
        if ($id > 9999 && $id < 100000) {
            return $id;
        }
    }

    /**
     * @param $name
     * @param $code
     * @param $email
     * @return bool
     */
    public function send($name, $code, $email)
    {
        try {
            Mail::to($email)->send(new CodeMail($name, $code));
            return true;
        } catch (\Exception $exception) {
            return false;
        }

    }
}
