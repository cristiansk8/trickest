<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the teams.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /* // Get all equipment
        $teams = Team::all(); */

        $teams = Team::with('skates')->get(); // Utiliza 'skates' en lugar de 'skate'

        // Returns the equipment in JSON format
        return response()->json([
            "teams" => $teams,
            "message" => "Successfully retrieved teams.",
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $request->validate([
            "name" => "required|string",
            "icon" => "required|string",
            "score" => "required|integer",
        ]);

        // Crea un nuevo equipo
        $team = Team::create([
            "name" => $request->name,
            "icon" => $request->icon,
            "score" => $request->score,
        ]);

        // Retorna una respuesta con el equipo creado y un mensaje
        return response()->json([
            "team" => $team,
            "message" => "Successfully created team.",
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified team.http://localhost:8000/api/skates
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // Busca el equipo por su ID
        /* $team = Team::findOrFail($id); */
        $team = Team::with("skates")->findOrFail($id);

        // Retorna el equipo encontrado y un mensaje
        return response()->json([
            "team" => $team,
            "message" => "Team found.",
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Valida los datos de entrada
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'score' => 'required|integer',
        ]);

        // Busca el equipo por su ID
        $team = Team::findOrFail($id);

        // Actualiza los datos del equipo
        $team->update([
            "name" => $request->name,
            "icon" => $request->icon,
            "score" => $request->score,
        ]);

        // Retorna una respuesta con el equipo actualizado y un mensaje
        return response()->json([
            "team" => $team,
            "message" => "Successfully updated team.",
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified team from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // Busca el equipo por su ID y lo elimina
        Team::findOrFail($id)->delete();

        // Retorna un mensaje de éxito
        return response()->json([
            "message" => "Successfully deleted team.",
        ], Response::HTTP_OK);
    }
}
