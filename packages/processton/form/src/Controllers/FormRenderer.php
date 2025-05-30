<?php

namespace Processton\Form\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class FormRenderer extends BaseController
{
   public function index($id, Request $request)
   {
    
        if($request->getMethod() === 'POST') {
            return $this->store($id, $request);
        }

       return view('processton-form::renderer', [
           'form' => \Processton\Form\Models\Form::findOrFail($id),
       ]);
   }

   public function store($id, Request $request){

        $form = \Processton\Form\Models\Form::findOrFail($id);

        dd($request->all(), $form->id, $form->title, $form->description);
        
   }



   public function embeded($id, Request $request)
   {
        if($request->getMethod() === 'POST') {
            return $this->store($id, $request);
        }
       return view('processton-form::embed', [
           'form' => \Processton\Form\Models\Form::findOrFail($id),
       ]);
   }
}
