<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;


class TeamUserController extends Controller
{


    //
    public function edit($id)
    {
        $user = User::find($id);

        // Verifique se o usuário com o ID fornecido existe
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado!',
            ], 404);
        }

        // Recuperar equipes associadas ao usuário
        $teams = $user->teams;

        return response()->json([
            'status' => 200,
            'teams' => $teams,
        ]);
    }

    public function getTeamCourses($teamId)
    {
        
        $team = Team::find($teamId);

        // Check if the team with the given ID exists
        if (!$team) {
            return response()->json([
                'status' => 404,
                'message' => 'Team não encontrado',
            ], 404);
        }

        // Retrieve courses associated with the team
        $courses = $team->cursos;

        return response()->json([
            'status' => 200,
            'courses' => $courses,
        ]);
    }

}
