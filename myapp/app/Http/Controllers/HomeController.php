<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Logs;
use App\Models\Projects;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    // index function
    public function index()
    {
        // get max 10 logs
        $logs = Logs::orderBy('id','desc')->limit(10)->get();
        return view('home.index',['logs'=>$logs]);
    }

    public function team(){
      // get files from storage and map
        $files = collect(\Storage::files('public/uploads/'))->map(function($file) {
            return [
                'name' => basename($file),
                'path' => $file,
                'file' => Storage::url($file),
            ];
        });
       return view('home.team',['files'=>$files]);
    }

    public function store(Request $request){
        // validate request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file-upload' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->saveFile();
        // save to log
        $log = new Logs();
        $log->title = $request->get('name');
        $log->description = $request->get('description');
        $log->url = $this->saveFile();
        // if save is successful
        if($log->save()){
            // session message
            $request->session()->flash('message', 'File Uploaded Successfully');
            return redirect()->route('home.team');
        }
        return redirect()->back('home.team')->with('error','Something went wrong!  Please try again.');
    }

    // delete files function
    public function delete(){
        // get files from storage
        $files = collect(\Storage::files('public/uploads/'))->map(function($file) {
            return [
                'name' => basename($file),
                'path' => $file,
                'file' => Storage::url($file),
            ];
        });
        // delete files from storage
        foreach($files as $file){
            Storage::delete($file['path']);
        }
        return redirect()->route('home.index');
    }

    // projects function
    public function projects(){
        return view('home.projects');
    }


    // save file function
    private function saveFile(){
        $file = request()->file('file-upload');
       $path = $file->store('public/uploads');
       return $path;
    }

    // Api Section

    // get all employees
    public function getEmployees(){
        // get employees from database and return json with first name and last name
        $employees = Employees::select('firstName','lastName')->get();
        return response()->json($employees);
    }

    // store project
    public function storeProject(Request $request){
        // validate request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'status' => 'required',
            'owner' => 'required',
            'color' => 'required',
        ]);
        // save to database
        $project = new Projects();
        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->startdate = $request->get('startdate');
        $project->status = $request->get('status');
        $project->owner = $request->get('owner');
        $project->color = $request->get('color');
        // if save is successful
        if($project->save()){
            // return json with success message
            return response()->json(['message'=>'Project Created Successfully']);
        }
        // return json with error message
        return response()->json(['message'=>'Something went wrong!  Please try again.']);
    }

    // get projects return json
    public function getProjects(){
        // get projects from database and return json with title, description, startdate, status, owner, color
        $projects = Projects::select('id','title','description','startdate','status','owner','color')
            ->orderBy('id','desc')->get()->map(function($project){
                $project->startdate = date('m/d/Y',strtotime($project->startdate));
                return $project;
            });
        return response()->json($projects);
    }

    // delete project
    public function deleteProject($id){
        // get project by id
        $project = Projects::find($id);
        // if project is found
        if($project){
            // delete project
            $project->delete();
            // return json with success message
            return response()->json(['message'=>'Project Deleted Successfully']);
        }
        // return json with error message
        return response()->json(['message'=>'Something went wrong!  Please try again.']);
    }

}
