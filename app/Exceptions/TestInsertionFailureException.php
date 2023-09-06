<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TestInsertionFailureException extends Exception
{
    public function report($exception)
    {
        $message= $exception->getMessage();
        Log::error('При попытке добавления в базу данных произошла ошибка:' . $message, ['user_id' => Auth::user()->id]);
    }
    public function render()
    {
        return response()->view(
            'errors.test-failure',
            array('message' => 'При попытке добавления в базу данных произошла ошибка. Попробуйте еще раз'));
    }
}
