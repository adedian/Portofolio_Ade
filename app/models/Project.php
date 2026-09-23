<?php

namespace App\Models;

use App\Core\Database;

class Project
{
    public static function all(): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->query('SELECT * FROM projects WHERE is_placeholder = 0 ORDER BY sort_order ASC');
        return $stmt->fetchAll();
    }

    public static function featured(): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->query('SELECT * FROM projects WHERE featured = 1 AND is_placeholder = 0 ORDER BY sort_order ASC');
        return $stmt->fetchAll();
    }

    public static function bySlug(string $slug): ?array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return null;
        }

        $stmt = $pdo->prepare('SELECT * FROM projects WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $project = $stmt->fetch();

        return $project ?: null;
    }

    public static function images(int $projectId): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->prepare('SELECT * FROM project_images WHERE project_id = :id ORDER BY sort_order ASC');
        $stmt->execute(['id' => $projectId]);
        return $stmt->fetchAll();
    }

    public static function next(int $currentSortOrder): ?array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return null;
        }

        $stmt = $pdo->prepare(
            'SELECT * FROM projects WHERE sort_order > :order AND is_placeholder = 0 ORDER BY sort_order ASC LIMIT 1'
        );
        $stmt->execute(['order' => $currentSortOrder]);
        $next = $stmt->fetch();

        if ($next) {
            return $next;
        }

        $stmt = $pdo->query('SELECT * FROM projects WHERE is_placeholder = 0 ORDER BY sort_order ASC LIMIT 1');
        return $stmt->fetch() ?: null;
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return null;
        }

        $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public static function create(array $data): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO projects
                (slug, number, title, category, filter_group, year, role, description, overview,
                 problem, approach, solution, result, technologies, features, thumbnail,
                 is_academic, featured, sort_order)
             VALUES
                (:slug, :number, :title, :category, :filter_group, :year, :role, :description, :overview,
                 :problem, :approach, :solution, :result, :technologies, :features, :thumbnail,
                 :is_academic, :featured, :sort_order)'
        );

        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $data['id'] = $id;

        $stmt = $pdo->prepare(
            'UPDATE projects SET
                slug = :slug, number = :number, title = :title, category = :category,
                filter_group = :filter_group, year = :year, role = :role, description = :description,
                overview = :overview, problem = :problem, approach = :approach, solution = :solution,
                result = :result, technologies = :technologies, features = :features,
                thumbnail = :thumbnail, is_academic = :is_academic, featured = :featured,
                sort_order = :sort_order
             WHERE id = :id'
        );

        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
