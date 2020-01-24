<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $fillable = ['log_name','log_path','user_id'];
    /**
     * Get the user that owns the phone.
     */
    public function user(){
        return $this->belongsTo(App\User::class);
    }
}
