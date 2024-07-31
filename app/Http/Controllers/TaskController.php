<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version = "0.0.1",
 *      title  = "Api rest Documentation for Tasks",
 *      description = "Api Rest for educational purposes"
 * )
 * */
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    //security={{"bearer":{}}},
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *       path="/api/tasks",
     *      tags ={"tasks"},
     *      summary = "Show task list",
     *      security={{"bearer":{}}},
     *      @OA\Response(
     *           response=200,
     *          description="Show all tasks"
     *     ),
     *     @OA\Response(
     *           response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *       response = "default",
     *      description = "An error occurred"
     *    )
     * )
     */
    public function index()
    {
        $task = Task::all();

        return response()->json([
            'tasks' => $task
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     path="/api/tasks",
     *     tags ={"tasks"},
     *     summary = "Create a task",
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="content",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Tarea 53",
     *                     "description":"Tarea automatica",
     *                     "content":"Esta es una tarea de prueba"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *        response=200,
     *        description="Task created successfully"
     *     ),
     *     @OA\Response(
     *           response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *       response = "default",
     *      description = "An error occurred"
     *    )
     * )
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required|max:50',
            'content' => 'required|max:100'
        ]);
        $task =  Task::create($request->all());

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     tags ={"tasks"},
     *     summary = "Show task info",
     *     security={{"bearer":{}}},
     *     @OA\Parameter (
     *      description = "Parameter to search the task",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *      @OA\Schema (type = "integer"),
     *      @OA\Examples( example = "int", value = "1", summary = "Enter a task id number")
     *    ),
     *     @OA\Response(
     *      response = 200,
     *      description = "Show task info"
     *    ),
     *     @OA\Response(
     *      response = 404,
     *      description = "The task has not been found"
     *    ),
     *   @OA\Response(
     *           response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *       response = "default",
     *       description = "An error occurred"
     *    )
     * )
     */
    public function show($id)
    {
        $task = Task::find($id);

        if(is_null($task))
        {
            return response()->json([
                'message' => 'The task has been not found',
            ],404);
        }
        else
        {
            return response()->json([
                'message' => 'Task found successfully',
                'task' => $task
            ],200);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put (
     *     path="/api/tasks/{id}",
     *     tags ={"tasks"},
     *     summary = "Update a task",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema (type = "integer"),
     *         @OA\Examples( example = "int", value = "1", summary = "Enter a task id number")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="content",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Tarea 53",
     *                     "description":"Tarea automatica",
     *                     "content":"Esta es una tarea de prueba"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Task updated success"
     *      ),
     *     @OA\Response(
     *      response = 404,
     *      description = "The task has not been found"
     *    ),
     *    @OA\Response(
     *           response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *       response = "default",
     *      description = "An error occurred"
     *    )
     * )
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required|max:50',
            'content' => 'required|max:100'
        ]);

        $task = Task::find($id);

        if(is_null($task))
        {
            return response()->json([
                'message' => 'The task has been not found',
            ],404);
        }
        else
        {
            $task->update($request->all());
            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete (
     *     path="/api/tasks/{id}",
     *     tags ={"tasks"},
     *     summary = "Delete a task",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *          @OA\Examples( example = "int", value = "1", summary = "Enter a task id number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task delete successfully"
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="The task has been not found"
     *      ),
     *      @OA\Response(
     *           response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *       response = "default",
     *      description = "An error occurred"
     *    )
     * )
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if(is_null($task))
        {
            return response()->json([
                'message' => 'The task has been not found',
            ],404);
        }
        $task->delete();

        return response()->json([
                'message' => 'Task deleted successfully'
            ]);
    }
}
