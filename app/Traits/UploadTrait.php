<?php
namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadTrait{

 public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type){
  if($request->hasFile($inputname)){
   if(!$request->file($inputname)->isValid()){
    Session()->flash('error');
    return redirect()->back()->withInput();
   }
   $photo = $request->file($inputname);
   $name = Str::slug($request->input('name'));
   $filename = $name . '.' . $photo->getClientOriginalExtension();

   // inset image
   $Image = new Image();
   $Image->filename = $filename;
   $Image->imageable_id = $imageable_id;
   $Image->imageable_type = $imageable_type;
   $Image->save();
   return $request->file($inputname)->storeAs($foldername, $filename, $disk);
  }
 }

 public function verifyAndStoreImageForeach($varForeach, $foldername, $disk, $imageable_id, $imageable_type){
   // inset image
   $Image = new Image();
   $Image->filename = $varForeach->getClientOriginalName();
   $Image->imageable_id = $imageable_id;
   $Image->imageable_type = $imageable_type;
   $Image->save();
   return $varForeach->storeAs($foldername, $varForeach->getClientOriginalName(), $disk);
 }

 public function delete_attachments($disk, $path, $id, $filename){
  Storage::disk($disk)->delete($path);
  Image::where('imageable_id', $id)->delete();
 }

}