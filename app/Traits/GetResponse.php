<?php

namespace App\Traits;

trait GetResponse
{
    
    public function dataResponse($data,$message='',$status=200){
        return response()->json([
            'message'=>$message,
            'data'=>$data
        ],$status);
    }

    public function successResponse($message,$data=[],$status=200){
        return response()->json([
            'message'=>$message,
            'data'=>$data
        ],$status);
    }

    public function errorResponse($message,$data=[],$status=200){
        return response()->json([
            'message'=>$message,
            'errors'=>$data
        ],$status);
    }
}
