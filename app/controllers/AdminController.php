<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Message;
use App\Models\Project;
use App\Models\User;

class AdminController extends Controller
{
    private const MAX_ATTEMPTS = 5;

    public function loginForm(): void
    {
        if (Auth::check()) {
            header('Location: ' . base_url('admin'));
            exit;
        }

        $this->render('admin/login', [
            'pageTitle' => 'Admin Login',
            'csrfToken' => Csrf::token(),
            'error'     => null,
        ]);
    }

    public function login(): void
    {
        if (!$this->isPost() || !Csrf::verify($_POST['_csrf'] ?? null)) {
            $this->render('admin/login', ['pageTitle' => 'Admin Login', 'csrfToken' => Csrf::token(), 'error' => 'Session expired, please try again.']);
            return;
        }

        $_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;

        if ($_SESSION['login_attempts'] >= self::MAX_ATTEMPTS) {
            $this->render('admin/login', ['pageTitle' => 'Admin Login', 'csrfToken' => Csrf::token(), 'error' => 'Too many attempts. Please try again later.']);
            return;
        }

        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $user = filter_var($email, FILTER_VALIDATE_EMAIL) ? User::findByEmail($email) : null;

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $_SESSION['login_attempts']++;
            $this->render('admin/login', ['pageTitle' => 'Admin Login', 'csrfToken' => Csrf::token(), 'error' => 'Invalid email or password.']);
            return;
        }

        $_SESSION['login_attempts'] = 0;
        Auth::login((int) $user['id']);
        $_SESSION['admin_name'] = $user['name'];

        header('Location: ' . base_url('admin'));
        exit;
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: ' . base_url('admin/login'));
        exit;
    }

    public function dashboard(): void
    {
        Auth::requireLogin();

        $this->render('admin/dashboard', [
            'pageTitle'    => 'Dashboard — Admin',
            'projectCount' => count(Project::all()),
            'messages'     => array_slice(Message::all(), 0, 5),
        ]);
    }

    public function projectsIndex(): void
    {
        Auth::requireLogin();

        $this->render('admin/projects/index', [
            'pageTitle' => 'Projects — Admin',
            'projects'  => Project::all(),
            'csrfToken' => Csrf::token(),
        ]);
    }

    public function projectCreateForm(): void
    {
        Auth::requireLogin();

        $this->render('admin/projects/form', [
            'pageTitle' => 'New Project — Admin',
            'project'   => null,
            'csrfToken' => Csrf::token(),
        ]);
    }

    public function projectEditForm(string $id): void
    {
        Auth::requireLogin();

        $project = Project::find((int) $id);
        if (!$project) {
            http_response_code(404);
            echo 'Project not found.';
            return;
        }

        $this->render('admin/projects/form', [
            'pageTitle' => 'Edit Project — Admin',
            'project'   => $project,
            'csrfToken' => Csrf::token(),
        ]);
    }

    public function projectSave(): void
    {
        Auth::requireLogin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            http_response_code(403);
            echo 'Session expired. Go back and try again.';
            return;
        }

        $id = (int) ($_POST['id'] ?? 0);

        $data = [
            'slug'         => trim((string) ($_POST['slug'] ?? '')),
            'number'       => trim((string) ($_POST['number'] ?? '')),
            'title'        => trim((string) ($_POST['title'] ?? '')),
            'category'     => trim((string) ($_POST['category'] ?? '')),
            'filter_group' => trim((string) ($_POST['filter_group'] ?? 'WEB')),
            'year'         => trim((string) ($_POST['year'] ?? '')),
            'role'         => trim((string) ($_POST['role'] ?? '')),
            'description'  => trim((string) ($_POST['description'] ?? '')),
            'overview'     => trim((string) ($_POST['overview'] ?? '')),
            'problem'      => trim((string) ($_POST['problem'] ?? '')),
            'approach'     => trim((string) ($_POST['approach'] ?? '')),
            'solution'     => trim((string) ($_POST['solution'] ?? '')),
            'result'       => trim((string) ($_POST['result'] ?? '')),
            'technologies' => trim((string) ($_POST['technologies'] ?? '')),
            'features'     => trim((string) ($_POST['features'] ?? '')),
            'thumbnail'    => trim((string) ($_POST['thumbnail'] ?? '')) ?: null,
            'is_academic'  => !empty($_POST['is_academic']) ? 1 : 0,
            'featured'     => !empty($_POST['featured']) ? 1 : 0,
            'sort_order'   => (int) ($_POST['sort_order'] ?? 0),
        ];

        if ($data['slug'] === '' || $data['title'] === '') {
            http_response_code(422);
            echo 'Slug and title are required.';
            return;
        }

        if ($id > 0) {
            Project::update($id, $data);
        } else {
            Project::create($data);
        }

        header('Location: ' . base_url('admin/projects'));
        exit;
    }

    public function projectDelete(string $id): void
    {
        Auth::requireLogin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            http_response_code(403);
            echo 'Session expired.';
            return;
        }

        Project::delete((int) $id);
        header('Location: ' . base_url('admin/projects'));
        exit;
    }

    public function messagesIndex(): void
    {
        Auth::requireLogin();

        $this->render('admin/messages/index', [
            'pageTitle' => 'Messages — Admin',
            'messages'  => Message::all(),
            'csrfToken' => Csrf::token(),
        ]);
    }

    public function messageDelete(string $id): void
    {
        Auth::requireLogin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            http_response_code(403);
            echo 'Session expired.';
            return;
        }

        Message::delete((int) $id);
        header('Location: ' . base_url('admin/messages'));
        exit;
    }
}
