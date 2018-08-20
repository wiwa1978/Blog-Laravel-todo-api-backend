<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        TodoResource::withoutWrapping();

        $todos = Todo::all();
        return TodoResource::collection($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'completed' => 'required',
        ]);

        $todo = Todo::create([
            'name' => $request->name,
            'description' => $request->description,
            'completed' => $request->completed,
            'user_id' => 1,
        ]);

        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        TodoResource::withoutWrapping();
        return (new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'completed' => 'required',
        ]);

        $todo->update([
                $todo->name = $request->name,
                $todo->description = $request->description,
                $todo->completed = $request->completed
            ]);

        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if ($todo->delete()) {
            return new TodoResource($todo);
        }
    }
}
