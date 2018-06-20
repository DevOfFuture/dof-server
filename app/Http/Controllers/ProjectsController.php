<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ProjectsController extends Controller
{
    //

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


    public function delete(Projects $project){
        $project->delete();
        return response()->json(null,204);
    }

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

    public function getOneProject(Projects $project){
        return Projects::findOrFail($project); 
    }

    
}
