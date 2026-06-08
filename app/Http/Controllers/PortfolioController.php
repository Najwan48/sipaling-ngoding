<?php
namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $projects = Project::latest()->get();
        $skills = Skill::all()->groupBy('category');

        return view('portfolio', compact(
            'profile', 
            'experiences', 
            'projects', 
            'skills'
        ));
    }
}
