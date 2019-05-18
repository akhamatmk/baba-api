<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;

class FileController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|unique:send_files|max:255',
            'username' => 'required|unique:send_files|max:255',
            'image' => 'required|mimes:jpeg,bmp,png'
        ]);
        
        if ($validator->fails()) {
            return [
            	'error' => true,
            	'message' => $validator->errors()->all(),
            	'data' => ""
            ];
        }
    }
}
