<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\chats;
use App\Models\comments;
use App\Models\location;
use App\Models\media;
use App\Models\reports;
use App\Models\statistics;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request){
        $fields = $request->validate([
            'username' =>'string|required',
            'password' =>'string|required'
        ]);
            $user = User::where('username',$fields['username'])->first();
        if(!$user || !($fields['password']==$user->password)){
            return response([
                'message' => 'Username or Password are incorrect'
            ],401);
        }
        $response= [
            'user'=>$user,
        ];
                return response($response,202);
    }

    public function indexchat()
    {
       
        $chat = chats::with('user')
                              ->get();

        return $chat;
    }

    public function chat($id)
    {
        $chat = chats::with('user')
                            ->with('comments')
                            ->find($id);

        return response()->json($chat,200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'CIN' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->CIN = $request->input('CIN');
        $user->password = $request->input('password');
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function commenting(Request $request)
    {
        
        $request->validate([
            'content' => 'required|string',
            'id_chat' => 'required',
        ]);
        $user = Auth::id();
        print_r($user);

        $comm = new comments();
        $comm->content = $request->input('content');
        $comm->id_user = Auth::user();
        $comm->id_chat = $request->input('id_chat');
        $comm->save();

        return response()->json(['message' => 'comment added successfully', 'comm' => $comm], 201);
    }

    public function indexreports()
{
    $rep = reports::with('localisation')
                  ->whereNotIn('confirmation', ['rejected'])
                  ->get();

    return $rep;
}

    public function indexstatistics()
    {
       
        $rep = statistics::where('state','true')
                            ->get();

        return $rep;
    }

    public function validateReport($reportId)
{
    $report = reports::find($reportId);

    if (!$report) {
        return response()->json(['message' => 'Rreport not found.'], 404);
    }

    $report->update(['confirmation' => 'validated']);

    return response()->json(['message' => 'Report successfily validated.', 'report' => $report], 200);
}

public function rejectReport($reportId)
{
    $report = reports::find($reportId);

    if (!$report) {
        return response()->json(['message' => 'Rapport non trouvé.'], 404);
    }

    $report->update(['confirmation' => 'rejected']);

    return response()->json(['message' => 'Message rejected successfuly', 'report' => $report], 200);
}

public function endfire($statisId)
{
    $stati = statistics::find($reportId);

    if (!$stati) {
        return response()->json(['message' => 'Report not found.'], 404);
    }

    $report->update(['state' => false]);

    return response()->json(['message' => 'Fire distinguished successfuly', 'stati' => $stati], 200);
}

public function newreport(Request $request)
{
    $request->validate([
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $location = new location();
    $location->longitude = $request->input('longitude');
    $location->latitude = $request->input('latitude');
    $location->save();

    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $imageName);

    $report = new reports();
    $report->id_user = Auth::id(); 
    $report->id_location = $location->id_location;
    $report->send_rescue = false;
    $report->proof = $imageName;
    $report->confirmation = 'unCheck';
    $report->save();

    return response()->json(['message' => 'Report created successfully', 'report' => $report], 201);
}

public function newstatistic(Request $request)
    {
        $request->validate([
            'id_location' => 'required|exists:locations,id_location',
            'injuries' => 'required|integer',
            'deaths' => 'required|integer',
        ]);

        $statistic = new statistics();
        $statistic->date_debut = now();
        $statistic->id_location = $request->input('id_location');
        $statistic->injuries = $request->input('injuries');
        $statistic->deaths = $request->input('deaths');
        $statistic->save();

        return response()->json(['message' => 'Statistic created successfully', 'statistic' => $statistic], 201);
    }

    public function closedstatistic(Request $request, $statisticId)
    {

        $request->validate([
            'date_fin' => 'nullable|date',
        ]);

        $statistic = statistics::find($statisticId);

        if (!$statistic) {
            return response()->json(['message' => 'Statistic not found.'], 404);
        }

        $statistic->date_fin = now(); 
        $statistic->state = false;
        $statistic->save();

        return response()->json(['message' => 'Statistic closed successfully', 'statistic' => $statistic], 200);
    }

    public function download($imageName)
    {
        $path = public_path('images/' . $imageName);

        if (file_exists($path)) {
            return Response::download($path, $imageName);
        } else {
            abort(404);
        }
    }


}
