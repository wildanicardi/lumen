<?php
namespace App\Http\Controllers;
use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    // list all items in given checklist
    public function getChecklist($checklistId,$itemsId)
    {
        $item = Item::with(['checklist'])
            ->find($itemsId)
            ->where('items.checklist_id',$checklistId)
            ->get();

            return response()->json([
                'data'=>[
                    'type' => $item->type,
                    'id' => $item->id,
                    'attributes' => [
                        'description' => $item->description,
                        'is_completed' => $item->is_completed,
                        'completed_at' => $item->completed_at,
                        'due' => $item->due,
                        'urgency' => $item->urgency,
                        'updated_by' => $item->updated_by,
                        'created_by' => $item->checklist->created_by,
                        'checklist_id' =>$item->checklist_id,
                        'assignee_id' => $item->checklist->assignee_id,
                        'task_id' => $item->checklist->task_id,
                        'deleted_at' => $item->checklist->deleted_at,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at
                    ],
                    'links' => [
                        'self' => $item->self
                    ]
                ]
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$checklistId)
    {
        $this->validate($request,[
            'description' =>'required',
            
        ]);
        $request['type'] = 'checklist';
        $request['is_completed'] = false;
        $getSelf  = Checklist::where('id',$checklistId)->get();
        $request['checklist_id'] = $checklistId;
        $item = Item::create($request->all());
        
        
        return response()->json([
            'data'=>[
                'type' => $request->type,
                'id' => $item->id,
                'attributes' => [
                    'description' => $item->description,
                    'is_completed' => $item->is_completed,
                    'completed_at' => $item->completed_at,
                    'due' => $item->due,
                    'urgency' =>$item->urgency,
                    'updated_by' => $item->updated_by,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ],
                'links' => [
                    'self' => $getSelf->self
                ]
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$checklistId,$itemsId)
    {
        $this->validate($request,[
            'description' =>'required',
            
        ]);
        $request['type'] = 'checklist';
        $request['is_completed'] = false;
        $getSelf  = Checklist::where('id',$checklistId)->get();
        $request['checklist_id'] = $checklistId;
        $item = Item::find($itemsId)->update($request->all());
        
        
        return response()->json([
            'data'=>[
                'type' => $request->type,
                'id' => $item->id,
                'attributes' => [
                    'description' => $item->description,
                    'is_completed' => $item->is_completed,
                    'completed_at' => $item->completed_at,
                    'due' => $item->due,
                    'urgency' =>$item->urgency,
                    'assignee_id' => $item->assignee_id,
                    'updated_by' => $item->updated_by,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ],
                'links' => [
                    'self' => $getSelf->self
                ]
            ]
        ]);
    }
    public function listAll($checklistId)
    {
        $item = Item::with(['checklist'])
        ->where('items.checklist_id',$checklistId)
        ->get();
        return response()->json([
            'data'=>[
                'type'=>$item->type,
                'id'=>$item->checklist->id,
                'attributes'=>[
                  'object_domain'=>$item->checklist->object_domain,
                  'object_id'=>$item->checklist->object_id,
                  'description'=>$item->checklist->description,
                  'is_completed'=>$item->checklist->is_completed,
                  'due'=>$item->checklist->due,
                  'urgency'=>$item->checklist->urgency,
                  'completed_at'=>$item->checklist->completed_at,
                  'last_update_by'=>$item->checklist->last_update_by,
                  'update_at'=>$item->checklist->update_at,
                  'created_at'=>$item->checklist->created_at,
                  'items'=>[
                    
                      'id'=>$item->id,
                      'name'=>$item->name,
                      'user_id'=>1,
                      'is_completed'=>false,
                      'due'=>$item->due,
                      'urgency'=>$item->urgency,
                      'checklist_id'=>$item->checklist_id,
                      'assignee_id'=>$item->assignee_id,
                      'task_id'=>$item->task_id,
                      'completed_at'=>$item->completed_at,
                      'last_update_by'=>$item->last_update_by,
                      'update_at'=>$item->update_at,
                      'created_at'=>$item->created_at,
                  ]
                ]
            ]
        ]);
                
    }
    public function completeItem(Request $request)
    {
        $item_id = $request->item_id;
        $request['is_completed'] = true;
        $request['checklist_id'] = 1;
        $item = Item::find($item_id)->update($request->all);
        return response()->json([
            'data'=>[
                'id' => $item->id,
                'item_id'=>$item_id,
                'is_completed'=>$item->is_completed,
                'checklist_id' => $item->checklist_id
            ]
        ]);
    }
    public function inCompleteItem(Request $request)
    {
        $item_id = $request->item_id;
        $request['is_completed'] = false;
        $request['checklist_id'] = 1;
        $item = Item::find($item_id)->update($request->all);
        return response()->json([
            'data'=>[
                'id' => $item->id,
                'item_id'=>$item_id,
                'is_completed'=>$item->is_completed,
                'checklist_id' => $item->checklist_id
            ]
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($checklistId,$itemsId)
    {
        $item = Item::with(['checklist'])
            ->find($itemsId)
            ->where('items.checklist_id',$checklistId)
            ->get();
        $item->forceDelete();

      return response()->json([
        'msg' => 'berhasil di hapus'
        ]);
    }

}