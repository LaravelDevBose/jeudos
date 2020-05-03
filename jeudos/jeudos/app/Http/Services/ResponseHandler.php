<?php


namespace App\Http\Services;


trait ResponseHandler
{
    public function validatorResponseHandler($validator)
    {
        if ($validator->fails()) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => $validator->getMessageBag()->all()
            ]);
            return redirect(url()->previous());
        }
        return true;
    }

    public function validatorJsonResponseHandler($validator){
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error !!!',
                'errors' => $validator->getMessageBag()->all()
            ],200);
        }
        return true;
    }

    public function successResponseHandler($message, $data = [], $title = 'Success', $url = '')
    {
        session()->put('notification', [
            'status' => 'success',
            'title' => $title,
            'message' => [
                $message
            ]
        ]);
        $returnUrl = $url == '' ? url()->previous() : url($url);
        return redirect($returnUrl);
    }

    public function successJsonResponse($message, $data = [],  $title = 'Success'){
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ],200);

    }

    public function errorResponseHandler($message, $errors = [], $title = 'Error', $url = '')
    {
        session()->put('notification', [
            'status' => 'error',
            'title' => $title,
            'message' => [
                $message
            ]
        ]);
        $returnUrl = $url == '' ? url()->previous() : url($url);
        return redirect($returnUrl);
    }

    public function errorJsonResponse($message, $errors = [],  $title = 'Error'){
        return response()->json([
            'status' => 'serror',
            'message' => $message,
            'errors' => $errors
        ],400);
    }
}
