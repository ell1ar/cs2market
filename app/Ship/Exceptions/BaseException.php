<?php

namespace App\Ship\Exceptions;

use Exception;

class BaseException extends Exception
{
    public function report()
    {
        return;
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'error' => $this->getMessage()
            ]);
        }

        return back()->with('error', $this->getMessage());
    }
}
