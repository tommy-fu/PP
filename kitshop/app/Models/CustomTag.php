<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTag extends \Spatie\Tags\Tag
{
    use HasFactory;

    protected $table = "tags";

    public function getNameAttribute($name){
        
        $array =
         [
             'react' => 'React',
             'html' => 'HTML',
             'javascript' => 'JavaScript',
             'tailwind' => 'Tailwind',
             'bootstrap' => 'Bootstrap'           
         ];
  
         return $array[$name];
      }

    public function getHoverText(){
         return $this->name;
      }

    public function getImage(){
        
      $array =
       [
           'React' => 'Union.svg',
           'HTML' => 'Subtract.svg',
           'JavaScript' => 'Exclude.svg',
           'Tailwind' => 'Vector.svg',
           'Bootstrap' => 'Vector-1.svg'           
       ];

       return '/images/' . $array[$this->name];
    }
    
}
