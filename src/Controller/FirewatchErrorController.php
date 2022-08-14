<?php

namespace KkSmiles\Firewatch\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use KkSmiles\Firewatch\Models\FirewatchError;

class FirewatchErrorController extends Controller
{
    public function index()
    {
        return view('firewatch::errors.index');
    }

    public function solved(Request $request)
    {
        // TODO - replace solve_at with solved date
        // TODO - replace solved_by_user_id with user_id

        $validated = $request->validate([
            'error_id' => ['required', 'integer'],
            'solved_by' => []
        ]);

        $error = FirewatchError::find($validated['error_id']);
        $error->solved_date = $validated['error_id'];
        $error->solved_by_user_id = $validated['error_id'];
        $error->save();

        return $error;
    }
}
