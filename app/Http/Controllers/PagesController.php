<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        $user = new user();

        if($user instanceof MustVerifyEmail)
        {
            return 1;
        }else{
            return 0;
        }
        return view('pages.root');
    }
}
