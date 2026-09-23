<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $slug): void
    {
        $project = Project::bySlug($slug);

        if (!$project) {
            http_response_code(404);
            $this->render('errors/404');
            return;
        }

        $images = Project::images((int) $project['id']);
        $next   = Project::next((int) $project['sort_order']);

        $this->render('projects/show', [
            'pageTitle'       => $project['title'] . ' — Ade Dian Sukmana',
            'pageDescription' => $project['description'],
            'canonical'       => base_url('projects/' . $project['slug']),
            'project'         => $project,
            'images'          => $images,
            'next'            => $next,
        ]);
    }
}
