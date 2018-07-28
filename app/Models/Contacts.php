<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 7/28/2018
 * Time: 10:31 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contacts extends Model
{
    use ToJson;

    protected $table      = 'contacts';
    protected $appends      = [];
    protected $hidden       = [];
    protected $fillable     = [ 'id', 'name' , 'email' , 'phone', 'city', 'state', 'country', 'postal_code' ];

    private $errors;

    public function store( Request $r )
    {
        $validator = \Validator::make( $r->all() , [
            // validation rules here
            'name'  => 'required',
            'email' => 'email',
            'phone' => 'required',
            'state' => 'required | size:2'
        ] );

        if( $validator->fails() ){
            $this->errors = $validator->errors()->all();
            return false;
        }

        $this->fill( $r->all() );
        $pk = $this->primaryKey;

        if( $r->$pk  ){
            $this->exists = true;
        }else{

        }

        $this->save();

        return $this;
    }

    /**
     * Get a collection of the model and filter it out
     *
     * @param Request $r
     * @return mixed
     */
    public function getCollection( Request $r )
    {
        $this->fields = [ 'a.*' ];

        $this->query = static::from( $this->table.' as a' );
        // apply filters here
        if( $r->with ){
            is_array( $r->with ) ? $this->query->with( $r->with ) : $this->query->with( [ $r->with ] );
        }

        if( $r->return_total ){
           $this->total = $this->query->count( );
        }

        if( $r->return_builder ){
            return $this->query;
        }

        return $this->query->get( $this->fields );
    }

    /**
     * Return the errors in HTML form
     *
     * @return string
     */
    public function displayErrors()
    {
        if( ! count( $this->errors )){
            return '';
        }

        $html = '<ul>';
        foreach( $this->errors as $e ){
            $html .= '<li>'.$e.'</li>';
        }
        $html .= '</ul>';

        return $html;
    }

}
