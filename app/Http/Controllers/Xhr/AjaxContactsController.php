<?php

namespace App\Http\Controllers\Xhr;


use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Http\Request;

class AjaxContactsController extends Controller
{
    public function getContacts( Request $r )
    {
        $contact = new Contacts();
        return [
            'success' =>true,
            'contacts' => $contact->getCollection( $r )
        ];
    }

    public function saveContact( Request $r )
    {
        $contact = new Contacts();

        // validation is found in the Contacts Model
        if( ! $contact->store( $r )){
            return [
                'success' => false,
                'message' => $contact->displayErrors()
            ];
        }

        return [
            'success' => true,
            'contact' => $contact
        ];
    }

    public function deleteContact( Request $r )
    {
        $contact = Contacts::find( $r->contact_id );
        if( ! $contact ){
            return [
                'success' =>false,
                'message' => 'Contact not found'
            ];
        }

        $contact->delete();

        return [
            'success' => true,
            'contact_id' => $r->contact_id
        ];
    }
}
