<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\tasks;
use App\Models\User;
use Response;
class TasksController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'descrp' => 'required',
            'time'=> 'required',
            'endtask'=> 'required',
            'starttask'=> 'required'
        ]);
        $data = new tasks();
        $data->name = $request->name;$data->descrp= $request->descrp;$data->time = $request->time;
        $data->starttask= $request->starttask;$data->endtask = $request->endtask;
        if(Auth::check()){
            User()->tasksuser()->save($data);
         return response()->json("Success");
         }else{
           return response()->json("failure");
         }
      
      
    }
 
    public function updateData(Request $request, $id)
    { $data = tasks::find($id);
        
        if(!$data){
            return   Response::json(['dataUpdated' => null , 'isUpdated' => false]);
            }
            
            $updated = $data->fill($request->all())->save();
            return  Response::json(['dataUpdated' => $data, 'isUpdated' => true]);
        }
    
    public function getAllData(){
        $data=tasks::all();
        if(!$data){
            return   Response::json(['data' => null , 'isEmpty' => true]);
            }
            else{
                return  Response::json(['data' => $data , 'isEmpty' => false]);
            } }
    public function destroy($id)
    { $data = tasks::find($id);
            if(!$data){
                return   Response::json(['dataDeleted' => null , 'isDeleted' => false]);
                }
                else{$data->delete();
                    return  Response::json(['dataDeleted' => $data , 'isDeleted' => true]);
                }
          
    }
}
