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
        $request->validate([
            'projectTitle'=> 'bail|required|unique:projects|max:255',
            'description'=> 'required'
        ]);

        $response = [
            "status" => "success",
            "data"=> null,
            "message"=> null
        ]; 
        
            $project = Projects::create($request->all());
            if( $project ) {
                $response['data'] = $project;
                $response['message'] = "Your project has been saved.";
                return response()->json($response, 201);
            }
            else{
                $response["status"] = "failure";
                $reponse["message"] = "Something went wrong please try again later";
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

        $response = [
            "status" => "success",
            "data" => null,
            "message"=>null
        ];
        if ($project->update( $request->all())) {
            $response["data"] = $project;
            $response["message"]= "Project updated.";
            return response()->json($response, 200);
        }
        $response["status"] = "failure";
        $reponse["message"] = "Something went wrong please try again later";

        return response()->json($response, 200);
        
    }

    /** 
     *  Retrieve a project by his ID (the primary key)
     *  @param Request $request
     *  @return JSON 
    **/

    public function getOneProject(Projects $project){
        /** @todo retrieve the list of developers associated to the project 
         *  And also the NGO Details
        **/

        // Retrieving developers associated to the project 
        $developersIds = explode(',',$project->developersIds);
        $devsList = [];
        $i = 0; 
        foreach( $developersIds as $id){
            $devsList[$i] = Developers::find((int) $id);
            $i++;   
        }
        
        // Retrieving the NGO associated to the project 
        $ngo = Ngo::where($project->ngo_id);

        $response = [
            "status" => "success",
            "project" => $project,
            "message" => null,
            "developers"=> $devsList,
            "ngo" => $ngo
        ];

        return response()->json($response, 200);
    }

    /** 
     *  Store a newly created project
     *  @param Request $request
     *  @return JSON 
     **/

     public function filterProject($status){
         
        $response = [
            "status" => "success",
            "data" => null,
            "message" => null
        ];
        $project = Projects::where('status',$status)->get();

        if(count($project) > 0){
        $response["data"] = $project;
            return response()->json($response, 200);
        }else{
            $response["message"]="Project not found";
            $response["status"]= "failure";
            return response()->json($response,500); 
        }
        
     }
}
