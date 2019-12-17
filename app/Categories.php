<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    //
    protected $table = 'm_category_detail';
    public $timestamps = false;

    public function getMC(Request $request){
    	$m_categories = DB::table('m_category')
                            ->get();
        return $m_categories;
    }
}
