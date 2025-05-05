<?php

namespace App\Http\Controllers\Cabins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabins\StoreCabinRequest;
use App\Http\Requests\Cabins\UpdateCabinRequest;
use App\Models\Cabin;
use App\Traits\GetResponse;
use App\Traits\Traits\Media;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    use GetResponse,Media;
    
    public function store(StoreCabinRequest $request){
        
        $data = $request->except('image');
        $path = 'images/cabins';

        if($request->hasFile('image')){
            $photoName = $this->UploadPhoto($request->image,$path);
            $data['image']=  $photoName;
        }
        Cabin::create($data);
        return $this->dataResponse($data,'Success',201);

    }


    // All Cabins
    public function indexes(){

        $cabins = Cabin::all();
         return $this->dataResponse($cabins,'Success');
    }


    // Edit Cabin
    public function edit($id){

        $cabin = Cabin::find($id);
        if(!$cabin){
           return $this->errorResponse('Cabins not Found','errors');
        }

        return $this->dataResponse($cabin,'Success');
    }


    // Update Cabin
    public function update(UpdateCabinRequest $request){
        
        $cabin = Cabin::find($request->id);
        if(!$cabin){
           return $this->errorResponse('Cabins not Found','errors');
        }

        $data = $request->except('id','image');

        // Update Image
        if($request->hasFile('image')){

            //Delete Image
            // $image_path =str_replace(url('/'),public_path(),$cabin->image);
            // if(file_exists($image_path)){
            //     unlink($image_path);
            // }
            $this->deletePhoto($cabin->image);

            // Upload New Image
            $newPhoto = $this->UploadPhoto($request->image,'images/cabins');
            $data['image']= $newPhoto;
        }
        //Update Data   
        $cabin->update($data);
        return $this->dataResponse($data,'Success');
    }


    // Delete Cabin 
    public function delete($id){
       $cabin = Cabin::find($id);
       if(!$cabin){
        return $this->errorResponse('Cabin Not Found','errors');
       }

       $this->deletePhoto($cabin->image);
       $cabin->delete();
       return $this->successResponse('Cabin is Deleted Successfully');
    }

     // Duplicate Cabin 
     public function duplicate($id){
        $cabin = Cabin::select('name','max_capacity','regular_price','discount','description','image')->where('id',$id)->first();

        if(!$cabin){
         return $this->errorResponse('Cabin Not Found','errors');
        }
        
        Cabin::create($cabin->toArray());
        return $this->successResponse('Cabin is Duplicated Successfully');
     }
}

