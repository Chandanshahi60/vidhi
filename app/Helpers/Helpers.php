<?php
      

if (! function_exists('prd')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function prd($data) {

        echo "<pre>";
        print_r($data);
        echo "</pre>";die;
    }
}

         
if (! function_exists('states')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function states($country=null) {

       return DB::table('states')->where(function($query) use ($country){
                    if(isset($country) && !empty($country)){
                        $query->where('country_id',$country);
                    }
                })->get();

    }
}

if (! function_exists('cities')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function cities($state=null) {

       return DB::table('cities')->where(function($query) use ($state){
                    if(isset($state) && !empty($state)){
                        $query->where('state_id',$state);
                    }
                })->get();

    }
}


if (! function_exists('setsociety')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function getsociety($society_id=null){

        if (!session()->has('society_id')) {
            $society = DB::table('society')->first();
            session()->put('society', $society);
        }
        else{
            $society = DB::table('society')->where('id',$society_id)->first();
            session()->put('society_id', $society_id);
        }

    }


}


