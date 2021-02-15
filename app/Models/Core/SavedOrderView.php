<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class SavedOrderView extends Model
{
    //
	
	public function user(){
		return $this->belongsTo("App\Models\Core\User");
	}
}
