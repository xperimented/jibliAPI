<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Colis extends Model
{
    protected $fillable = [
        'id','type','user_id','v_depart','v_arrive','d_depart','t_depart'
    ];

    protected $primaryKey = 'id';
}