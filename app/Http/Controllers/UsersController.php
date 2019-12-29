<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function search(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }
        $data = DB::table("users")
            ->select("id", "name")
            ->where('name', 'LIKE', "%$term%")
            ->get();
        return \Response::json($data);
    }
}
