<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringSearchController extends Controller
{
    public function index()
    {
        return view('string_search.index');
    }

    public function search(Request $request)
    {
        $input = strtoupper($request->input('keyword'));
        $term = strtoupper('KOKOLA GROUP, Gresik, Indonesia');

        $result = [];

        for ($i = 0; $i <= strlen($term) - strlen($input); $i++) {
            if (substr($term, $i, strlen($input)) === $input) {
                $result[] = $i;
            }
        }

        return response()->json(['result' => $result]);
    }
}
