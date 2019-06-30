<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Http\Controllers\Controller;

class ChecklistController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            
            'object_domain' => 'required',
            'object_id' =>'required',
            'description' =>'required',
            
        ]);
        $request['type'] = 'checklist';
        $request['self'] = "http://$_SERVER[HTTP_HOST]/api/v1/checklist/$request->id";
        $checklist = Checklist::create($request->all());
        
        return response()->json([
            'data'=>[
                'type' => $request->type,
                'id' => $checklist->id,
                'attributes' => [
                    'object_domain' => $checklist->object_domain,
                    'object_id' => $checklist->object_id,
                    'task_id' => $checklist->task_id,
                    'description' => $checklist->description,
                    'is_completed' => $checklist->is_completed,
                    'due' => $checklist->due,
                    'urgency' => $checklist->urgency,
                    'completed_at' =>$checklist->completed_at,
                    'updated_by' => $checklist->updated_by,
                    'created_by' => $checklist->created_by,
                    'created_at' => $checklist->created_at,
                    'updated_at' => $checklist->updated_at
                ],
                'links' => [
                    'self' => $checklist->self
                ]
            ]
        ]);
    }
    
    public function show($id){
        $checklist = Checklist::find($id);

        return response()->json([
            'data'=>[
                'type' => $checklist->type,
                'id' => $checklist->id,
                'attributes' => [
                    'object_domain' => $checklist->object_domain,
                    'object_id' => $checklist->object_id,
                    'task_id' => $checklist->task_id,
                    'description' => $checklist->description,
                    'is_completed' => $checklist->is_completed,
                    'due' => $checklist->due,
                    'urgency' => $checklist->urgency,
                    'completed_at' =>$checklist->completed_at,
                    'updated_by' => $checklist->updated_by,
                    'created_by' => $checklist->created_by,
                    'created_at' => $checklist->created_at,
                    'updated_at' => $checklist->updated_at
                ],
                'links' => [
                    'self' => $checklist->self
                ]
            ]
        ]);
    }

    public function update(Request $request,$id){
        $checklist = Checklist::find($id);
        if($checklist){
            $checklist->update($request->all());
            return response()->json([
                'data'=>[
                    'type' => $checklist->type,
                    'id' => $checklist->id,
                    'attributes' => [
                        'object_domain' => $checklist->object_domain,
                        'object_id' => $checklist->object_id,
                        'task_id' => $checklist->task_id,
                        'description' => $checklist->description,
                        'is_completed' => $checklist->is_completed,
                        'due' => $checklist->due,
                        'urgency' => $checklist->urgency,
                        'completed_at' =>$checklist->completed_at,
                        'updated_by' => $checklist->updated_by,
                        'created_by' => $checklist->created_by,
                        'created_at' => $checklist->created_at,
                        'updated_at' => $checklist->updated_at
                    ],
                    'links' => [
                        'self' => $checklist->self
                    ]
                ]
            ]);
        }
        else{
            return response()->json([
                'status' => '404',
                'error' => 'not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $checklist = Checklist::find($id);
        if($checklist){
            $checklist->delete();
            return response()->json([
                
            ],204);
        }
        else
        {
            return response()->json([
                'status' => '404',
                'error' => 'not found'
            ]);
        }
    }
}