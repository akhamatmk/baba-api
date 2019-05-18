<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DateTime;
use App\SendFile;

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
            	'error_message' => $validator->errors()->all(),
            	'data' => ""
            ];
        }

       	$file = $request->file('image')->getClientOriginalName();
       	$date = new DateTime();
       	$file_name = $date->format('YmdHms').$file;
       	$destinationPath ="images/";
       	$request->file('image')->move($destinationPath, $file_name);

        $send_files = new SendFIle();
        $send_files->email = $request->email;
        $send_files->username = $request->username;
        $send_files->image = $file_name;

        $duplicate = $this->checkDuplicateCharacter($request->username);
        if($duplicate)
        	$send_files->note = false;

        $send_files->save();

        return [
            	'error' => false,
            	'error_message' => null,
            	'data' => $send_files
            ];
    }

    function checkDuplicateCharacter($string)
    {
    	for($i = 0; $i < strlen($string); $i++) {  
		    for($j = $i+1; $j < strlen($string); $j++) {  
		        if($string[$i] == $string[$j] && $string[$i] != ' ')
		            return true;
		    }  		    
		}

		return false;
    }
}
