<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    //protected $timestamps = false;
    use HasFactory;
     protected $dates = ['published_at'];
     
    public function user(){
      return $this->belongsTo(User::class);
    }

    //Accessor
    public function getImageUrlAttribute($value){

        $imageUrl = "";
        if(! is_null($this->image)){
            $imagePath = public_path() . "/img/" .$this->image;
            if(file_exists($imagePath)){
               $imageUrl = asset("img/". $this->image);
            }
        }
        return $imageUrl;
    }

    //define a new scope for ordering latestFirst

    public function scopeLatestFirst($query){
        return $query->orderBy('created_at','desc');
    }

    public function scopePublished($query){
        return $query->where("published_at", "<=", Carbon::now());
    }

    public function getDateAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    //Accessor for exerpt
   
    public function getExerptHtmlAttribute($value){
        return $this->exerpt ? Markdown::convertToHtml(e($this->exerpt)): NULL ;
     }

    //Accessor for body
    public function getBodyHtmlAttribute($value){
       return $this->body ? Markdown::convertToHtml(e($this->body)): NULL ;
    }

    //relationship with category
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
