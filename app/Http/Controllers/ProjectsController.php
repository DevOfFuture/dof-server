<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\User; 
use App\Developers;
use App\Ngo; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectsController extends Controller
{
    /** 
     *  Store a newly created project
     *  @param Request $request
     *  @return JSON 
    **/

    public function store(Request $request){

        // Validating requests params 
        $request->validate([
            'projectTitle'=> 'bail|required|unique:projects|max:255',
            'description'=> 'required'
        ]);
     
        $project = Projects::create($request->all());
           
        if( $project ) {
            $response = $this->decorateResponse("success", "Your project has been saved.", $project);
            return response()->json($response, 201);
        }
        else{
            $response = $this->decorateResponse("faillure", "Something went wrong please try again later.", null);
            return response()->json($response, 500);
        }
       
    }

     /** 
     *  Delete a project
     *  @param Request $request
     *  @return JSON 
    **/

    public function delete(Projects $project){
        $project->delete();
        return response()->json(null,204);
    }

    /** 
     *  Update a  project
     *  @param Request $request
     *  @return JSON 
    **/

    public function update(Request $request, Projects $project ){

        if ($project->update( $request->all())) {
            $response = $this->decorateResponse("success", "Project updated.", $project);
            return response()->json($response, 200);
        }
        $response = $this->decorateResponse("failure", "Something went wrong please try again later.", null);
        return response()->json($response, 200);
    }

    /** 
     *  Retrieve a project by its ID (the primary key)
     *  @param Request $request
     *  @return JSON 
    **/

    public function getOneProject(Projects $project){
        $this->decorateProject($project);
        $response = $this->decorateResponse("success", "Project retrieved well.", $project);
        return response()->json($response, 200);
    }

    /** 
     *  Store a newly created project
     *  @param Request $request
     *  @return JSON 
     **/

     public function filterProject($status){
         
        $projects = Projects::where('status',$status)->get();
        
        if(count($projects) > 0){

            foreach ($projects as $project) {
                $this->decorateProject($project);
            }
           $response= $this->decorateResponse("success", "Projects retrieved well.",$projects);
            return response()->json($response, 200);
        }else{
            $response = $this->decorateResponse("failure", "Project not found.", $projects);
            return response()->json($response,500); 
        }
        
     }


     /**
      * Decorates a project with its developers list and the ngo associated
      * @param App\Project $project
      * @return void 
      * 
      */
     public function decorateProject(&$project){
        
        // Retrieving developers associated to the project 
        $developersIds = explode(',', $project->developersIds);
        $devsList = [];
        $i = 0;
        foreach ($developersIds as $id) {
            $devsList[$i] = Developers::find((int)$id);
            $i++;
        }
        // Retrieving the NGO associated to the project 
        $ngo = Ngo::where($project->ngo_id);
        $project->ngo = $ngo; 
        $project->developers = $devsList; 
     }

     /**
      * Decorate a response with given data
      * @param mixed 
      * @return JSON
      */
     public function decorateResponse($status=null,$message=null,$data,$params=[]){
        //  return $data;  
        $response = [
            "status" => "success",
            "data" => $data,
            "message" => null
        ];

        if(isset($status) && $status!=null ) $response["status"] = $status;
        if( isset($message) && $message!=null) $response["message"] = $message;
        
        if( count($params)> 0){
            foreach( $params as $key => $value){
                $response[$key] = $value;
            }
        }
        return $response;
        
     }
}
