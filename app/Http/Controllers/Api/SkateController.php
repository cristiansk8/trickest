<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/* Models */
use App\Models\Skate;
use App\Models\Team;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SkateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Utiliza la función with() para cargar la relación teams
        $skates = Skate::with('team')->get();

        // Devuelve una respuesta JSON que incluya los skates y un mensaje
        return response()->json([
            "skates" => $skates,
            "message" => "Skate List"
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //
            $request->validate([
                "name" => "required|string",
                "foto" => "required|string",
                "redes" => "required|string",
                "score" => "required|integer",
                "email" => "required|string",
                "password" => "required|string",
                "team_id" => "required|integer"
            ]);

            //Buscar team id
            $team = Team::findOrFail($request->team_id);

            //Create a new skate
            $skate = $team->skates()->create([
                "name" => $request->name,
                "foto" => $request->foto,
                "redes" => $request->redes,
                "score" => $request->score,
                "email" => $request->email,
                "password" => $request->password
            ]);

            return response()->json([
                "resutl" => $skate,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            // Imprime los detalles del error en la consola
            dd($e->getMessage());
            // Retorna una respuesta JSON con el mensaje de error
            return response()->json([
                "result" => $e->getMessage(),
            ], Response::HTTP_CONFLICT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Utiliza el método with() para cargar la relación team
        $skate = Skate::with('team')->findOrFail($id);

        // Retorna el skate encontrado, incluyendo la información del equipo asociado, junto con un mensaje
        return response()->json([
            "skate" => $skate,
            "message" => "Skate found.",
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */

    /* public function update(Request $request, String $skate_id)
    {
        // Validación de los datos recibidos en la solicitud
        $request->validate([
            "name" => "required|string",
            "foto" => "required|string",
            "redes" => "required|string",
            "score" => "required|integer",
            "email" => "required|string",
            "password" => "required|string",
            "team_id" => "required"
        ]);

        // Busca el equipo asociado al skate usando el ID del equipo proporcionado en la solicitud
        $team = Team::findOrFail($request->team_id);

        // Actualiza el skate relacionado con el equipo específico y con el ID dado, solo deja actualizar cuando es el mismo equipo
        $skate = $team->skates()->where("id", $skate_id)->update([
            "name" => $request->name,
            "foto" => $request->foto,
            "redes" => $request->redes,
            "score" => $request->score,
            "email" => $request->email,
            "password" => $request->password,
            "team_id" => $request->team_id,
        ]);

        // Retorna una respuesta JSON indicando que el skate ha sido actualizado y el resultado de la actualización
        return response()->json([
            "message" => "Skate updated.",
            "result" => $skate,
        ]);
    }
    */
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, String $skate_id)
    {
        try {
            // Busca el skate por su ID
            $skate = Skate::findOrFail($skate_id);

            // Actualiza los datos del skate con los valores proporcionados en la solicitud
            $skate->update([
                "name" => $request->name,
                "foto" => $request->foto,
                "redes" => $request->redes,
                "score" => $request->score,
                "email" => $request->email,
                "password" => $request->password,
                "teams_id" => $request->team_id,
            ]);

            // Retorna una respuesta JSON indicando que el skate ha sido actualizado y el resultado de la actualización
            return response()->json([
                "message" => "Skate updated.",
                "skate" => $skate,
            ]);
        } catch (ModelNotFoundException $exception) {
            // Manejo de excepción ModelNotFoundException
            return response()->json([
                "message" => "Skate not found.",
            ], Response::HTTP_NOT_FOUND);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Skate::findOrFail($id)->delete();
            return response()->json([
                "result" => "Skate deleted.",
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "result" => $e->getMessage(),
            ], Response::HTTP_CONFLICT);
        }
    }
}
