<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Http\Services\ResponseHandler;
use App\InfluencerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    use ResponseHandler;

    public function index(){
        $faqs = Faq::orderBy('id','desc')->get();
        return view('pages.backend.faqs',get_defined_vars());
    }

    public function enable($id){
            $id = decrypt($id);
            if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
            $faq = Faq::find($id);
            $faq->status = 1;
            $faq->update();
            return $this->successResponseHandler('FAQ enabled successfully');
    }

    public function disable($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $faq = Faq::find($id);
        $faq->status = 0;
        $faq->update();
        return $this->successResponseHandler('FAQ disabled successfully');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        Faq::updateOrCreate([
            'id' => $request->id,
        ],[
            'question' => $request->question,
            'answer' => $request->answer
        ]);
        return $this->successResponseHandler('FAQ disabled successfully');
    }
}
