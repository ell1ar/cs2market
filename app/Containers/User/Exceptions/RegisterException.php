<?php

namespace App\Containers\User\Exceptions;

use Exception;

class RegisterException extends Exception
{
    public function render()
    {
        return redirect()->route('register.show')->with([
            'status' => 'error',
            'msg' => $this->getMessage()
        ]);
    }
}
