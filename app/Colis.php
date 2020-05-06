<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Colis extends Model
{
    protected $fillable = [
        'type','v_depart','v_arrive','d_depart','t_depart'
    ];
}