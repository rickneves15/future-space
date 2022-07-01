<?php

namespace App\Http\Controllers;

use App\Models\Launcher;
use Illuminate\Http\Request;

class LaunchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 20;
        $query = Launcher::query();

        if ($request->search) {
            $query->where('dataset', 'LIKE', "%{$request->search}%");
        }

        if ($request->status) {
            $query->where('dataset', 'LIKE', "%{$request->search}%");
        }

        $launchers = $query->orderBy()->paginate($perPage);
        return response()->json($launchers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($launchId)
    {
        $launcher = Launcher::whereJsonContains('dataset->id', $launchId)->first();
        return response()->json($launcher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $launchId)
    {
        $input = $request->all();
        $launcher = Launcher::whereJsonContains('dataset->id', $launchId);
        if (array_key_exists('launcher', $input) && !empty($input['launcher'])) {
            $launcherToUpdate = json_encode($input['launcher'], true);
            $launcherMerged = array_replace_recursive(json_decode($launcher->first(), true), json_decode($launcherToUpdate, true));

            $launcher->update($launcherMerged);
            return response()->json(["message" => "Launcher updated successfully."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($launchId)
    {
        $launcher = Launcher::whereJsonContains('dataset->id', $launchId);
        if (count($launcher->get()) > 0) {
            $launcher->delete();
            return response()->json(["message" => "Launcher deleted successfully."]);
        }
        return response()->json(["message" => "Launcher is not exist."]);
    }
}
