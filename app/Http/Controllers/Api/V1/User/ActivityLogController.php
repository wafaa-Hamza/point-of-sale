<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\UseractivityResource;

class ActivityLogController extends Controller
{

    public function getActivityByFilter(Request $request)
    {
        $this->authorize('view-activity log');

        if ($request->type == 'Reservation') {


            $activities =  UseractivityResource::collection(Activity::whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date)
                ->where('log_name', $request->type)
                ->where('subject_id', $request->id)
                ->with('causer')
                ->orwhereHas('causer', function ($query) use ($request) {
                    $query->where('id', $request->user_id);
                })
                ->get());
        }
        // if ($request->type == 'Room') {
        //     $activities =  UseractivityResource::collection(Activity::whereDate('created_at', '>=', $request->start_date)
        //         ->whereDate('created_at', '<=', $request->end_date)
        //         ->where('log_name', $request->type)
        //         ->where('subject_id', $request->id)
        //         ->with('causer')
        //         ->orwhereHas('causer', function ($query) use ($request) {
        //             $query->where('id', $request->user_id);
        //         })
        // ->get());

        if ($request->type == 'Normal') {
            $activities =  UseractivityResource::collection(Activity::whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date)
                ->with('causer')
                ->orwhereHas('causer', function ($query) use ($request) {
                    $query->where('id', $request->user_id);
                })
                ->get());
        }


        return response()->json($activities);
    }
    public function activityPagination()
    {
        $this->authorize('view-activity log');

        /* $activitywithsubject = collect();
        $activitywithoutsubject = collect(); */
        $activities =  UseractivityResource::collection(Activity::paginate(request()->segment(count(request()->segments()))));
        /* foreach ($activities as $activity) {
            if ($activity->subject_type == null) {
                $activitywithsubject->push($activity);

            } else {
                $string = explode('\\', $activity->subject_type);
                $activity_model_name = array_pop($string);
                $username = $activity->subject->firstname.' '.$activity->subject->lastname;
                $activitywithoutsubject->push(['description' => $activity_model_name. ' ' .$activity->description ,'changes'=>$activity->changes]);
            }
        } */
        return response()->json($activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  $this->authorize('view-activity log');

        $activity = Activity::findOrFail($id);
        return response()->json($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
