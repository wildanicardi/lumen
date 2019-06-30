<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateItem()
    {
        $this->json('POST', '/checklists/{checklistId}/items')
        ->seeJassertJsonStructureson([
            'data'=>[
                'type',
                'id',
                'attributes',
                    'is_completed',
                    'completed_at',
                    'due',
                    'urgency',
                    'updated_by',
                    'created_at',
                    'updated_at'
                ],
                'links'=>[
                    'self'
                ]
        ]);
    }
    public function testGetChecklistItem()
    {
        $response = $this->json('GET', '/checklists/{checklistId}/items/{itemId}');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'=>[
                'type' ,
                'id' ,
                'attributes' => [
                    'description' ,
                    'is_completed' ,
                    'completed_at' ,
                    'due' ,
                    'urgency' ,
                    'updated_by' ,
                    'created_by' ,
                    'checklist_id' ,
                    'assignee_id' ,
                    'task_id' ,
                    'deleted_at' ,
                    'created_at' ,
                    'updated_at' 
                ],
                'links' => [
                    'self' 
                ]
            ]
        ]);
    }
    public function testUpdateChecklistItem()
    {
        $this->json('PATCH', '/checklists/{checklistId}/items/{itemId}')
        ->assertJsonStructure([
            'data'=>[
                'type',
                'id',
                'attributes' => [
                    'description',
                    'is_completed',
                    'completed_at',
                    'due',
                    'urgency',
                    'assignee_id',
                    'updated_by',
                    'created_at',
                    'updated_at'
                ],
                'links' => [
                    'self'
                ]
            ]
        ]);
    }
    public function testDelete()
    {
            $delete = $this->json('DELETE', '/checklists/{checklistId}/items/{itemId}');
            $delete->seeJson(['message' => "Product Deleted!"]);
    }
    public function testInclompeted()
    {
        $data = [
            'item_id' =>1,
            'item_id' => 2
      ];
      $response = $this->json('POST', '/checklists/incomplete',$data);
      $response->seeJson(['message' => "Unauthenticated."]);
    }
    public function testListAll()
    {
            $data =[
                'type'=>"checklists",
                'id'=>1,
                'attributes'=>[
                  'object_domain'=>"contact",
                  'object_id'=> "1",
                  'description'=>"Need to verify this guy house.",
                  'is_completed'=>false,
                  'due'=>null,
                  'urgency'=>0,
                  'completed_at'=>null,
                  'last_update_by'=>null,
                  'update_at'=>null,
                  'created_at'=>"2018-01-25T07:50:14+00:00",
                  'items'=>[
                    
                      'id'=>"1",
                      'name'=>"Sample",
                      'user_id'=>"1",
                      'is_completed'=>false,
                      'due'=>null,
                      'urgency'=>0,
                      'checklist_id'=>13,
                      'assignee_id'=>123,
                      'task_id'=>"123",
                      'completed_at'=>null,
                      'last_update_by'=>null,
                      'update_at'=>null,
                      'created_at'=> "2018-01-25T07:50:14+00:00",
                  ]
                ]
            ];
        $response = $this->json('GET', '/checklists/{checklistId}/items',$data);
        $response->seeJson(['message' => "Unauthenticated."]);
    }
    public function testCompleted()
    {
        $data = [
              'item_id' =>1,
              'item_id' => 2
        ];
        $response = $this->json('POST', '/checklists/complete',$data);
        $response->seeJson(['message' => "Unauthenticated."]);
    }

}
