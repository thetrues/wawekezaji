<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mkeka;
use App\Models\Matches;
use Illuminate\Support\Facades\Auth;

class MkekaController extends Controller
{

    //sports categories
    public function create_sport_category(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $category = \App\Models\SportCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json(['message' => 'Sport category created successfully', 'category' => $category], 201);
    }

    //Create mkeka admin only
    public function createMkeka(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_odds' => 'required|numeric|min:1',
            'sport_category_id' => 'required|exists:sports_categories,id',
            'visibility_type' => 'required|in:free,premium,pay_per_view',
            'pay_per_view_price' => 'nullable|numeric|min:0',
            'matches' => 'required|array|min:1',
            'matches.*.home_team' => 'required|string|max:255',
            'matches.*.away_team' => 'required|string|max:255',
            'matches.*.match_date' => 'required|date',
        ]);

        $mkeka = Mkeka::create([
            'title' => $request->title,
            'description' => $request->description,
            'total_odds' => $request->total_odds,
            'sport_category_id' => $request->sport_category_id,
            'visibility_type' => $request->visibility_type,
            'pay_per_view_price' => $request->pay_per_view_price,
            'status' => 'draft',
            'created_by' => Auth::user()->id, // Assuming user is authenticated
        ]);

        //create matches for the mkeka
        $matches = $request->matches;

        if ($matches && is_array($matches)) {
            foreach ($matches as $matchData) {
                $matchData['mkeka_id'] = $mkeka->id;
                Matches::create($matchData);
            }
        }

        return response()->json(['message' => 'Mkeka created successfully', 'mkeka' => $mkeka], 201);
    }

    //Get all mkekas
    public function getAllMkekas(Request $request){

        $status = $request->query('status', ['draft', 'published', 'expired', 'cancelled']);
        if(!is_array($status)){
            $status = explode(',', $status);
        }
        $mkekas = Mkeka::with('matches')->whereIn('status', $status)->get();
        return response()->json(['mkekas' => $mkekas], 200);
    }
}
