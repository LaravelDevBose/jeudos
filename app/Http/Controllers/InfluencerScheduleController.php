<?php

namespace App\Http\Controllers;

use App\Http\Services\ResponseHandler;
use App\InfluencerSchedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InfluencerScheduleController extends Controller
{
    use ResponseHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = InfluencerSchedule::where('user_id', Auth::id())->where('status', '1')->latest()->get();
        return view('pages.backend.schedule.index', [
            'schedules'=>$schedules,
        ]);
    }

    public function allSchedules()
    {
        if(Auth::user()->role('admin')){
            $schedules = InfluencerSchedule::all();
        }else {
            $schedules = InfluencerSchedule::where('user_id', auth()->id())->where('status', '1')->get();
        }
        $response = [];
        foreach ($schedules as $schedule) {
            $response[] = [
                'title'=>date('d, D M Y G:i A', strtotime($schedule->start_date)).'-'.date('d, D M Y G:i A', strtotime($schedule->end_date)),
                'start' => $schedule->start_date,
                'end' => $schedule->end_date,
                'className' =>  'bg-info'
            ];
        }
        return $this->successJsonResponse('Schedules fetched', $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'start_date'=> 'required',
            'end_date'=> 'required',
        ]);
        $res = $this->validatorResponseHandler($validator);
        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $schedule = InfluencerSchedule::create([
                    'user_id'=> Auth::id(),
                    'start_date'=> $request->start_date,
                    'end_date'=> $request->end_date,
                ]);

                if (!empty($schedule)) {
                    DB::commit();
                    return $this->successResponseHandler('Schedule Added Successfully', '', '', route('schedule.index'));
                } else {
                    throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
                }

            }catch (\Exception $ex){
                DB::rollback();
                return $this->errorResponseHandler($ex->getMessage());
            }
        }else {
            return $res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $schedule = InfluencerSchedule::where('schedule_id', $id)->first();
        if (empty($schedule)){
            return abort(404);
        }
        $schedules = InfluencerSchedule::where('user_id', Auth::id())->where('status', '1')->latest()->get();
        return view('pages.backend.schedule.index', [
            'schedule'=>$schedule,
            'schedules'=>$schedules,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'start_date'=> 'required',
            'end_date'=> 'required',
        ]);
        $res = $this->validatorResponseHandler($validator);
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $schedule = InfluencerSchedule::where('schedule_id', $id)->first();
                if (empty($schedule)){
                    throw new Exception('Invalid Schedule Information');
                }
                $schedule = $schedule->update([
                    'user_id'=> Auth::id(),
                    'start_date'=> $request->start_date,
                    'end_date'=> $request->end_date,
                ]);

                if (!empty($schedule)) {
                    DB::commit();
                    return $this->successResponseHandler('Schedule Update Successfully', '', '', route('schedule.index'));
                } else {
                    throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
                }

            }catch (\Exception $ex){
                DB::rollback();
                return $this->errorResponseHandler($ex->getMessage());
            }
        }else {
            return $res;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $schedule = InfluencerSchedule::where('schedule_id', $id)->first();
            if (empty($schedule)){
                throw new Exception('Invalid Schedule Information');
            }

            if ($schedule->delete()) {
                DB::commit();
                return $this->successResponseHandler('Schedule Update Successfully');
            } else {
                throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
            }

        }catch (\Exception $ex){
            DB::rollback();
            return $this->errorResponseHandler($ex->getMessage());
        }
    }
}
