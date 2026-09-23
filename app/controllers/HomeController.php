<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index', [
            'pageTitle'       => 'Ade Dian Sukmana — Web Developer & UI Designer',
            'pageDescription' => 'Web Developer & UI Designer based in Surabaya, Indonesia. Building digital experiences, websites and systems that solve real-world problems.',
            'canonical'       => base_url('/'),
            'projects'        => Project::all(),
            'experiences'     => Experience::all(),
            'skills'          => Skill::grouped(),
            'csrfToken'       => Csrf::token(),
        ]);
    }
}
