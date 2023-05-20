<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request)
    {
        return response()->json([
            'error' => 'API Exception',
            'message' => $this->getMessage(),
        ], 500);
    }
}
