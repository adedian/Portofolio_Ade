<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Message;

class ContactController extends Controller
{
    /**
     * Handles the contact form submission (AJAX, JSON response).
     * Protections: CSRF token, honeypot field, timing check, input validation/sanitization.
     */
    public function send(): void
    {
        if (!$this->isPost()) {
            $this->json(['success' => false, 'message' => 'Invalid request method.'], 405);
            return;
        }

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            $this->json(['success' => false, 'message' => 'Your session expired. Please refresh the page and try again.'], 403);
            return;
        }

        // Honeypot: real users never fill this hidden field.
        if (!empty($_POST['website'])) {
            $this->json(['success' => true, 'message' => 'Thanks! Your message has been sent.']);
            return;
        }

        // Timing check: form submitted too fast to be human.
        $renderedAt = (float) ($_POST['_rendered_at'] ?? 0);
        if ($renderedAt > 0 && (microtime(true) - $renderedAt) < 2) {
            $this->json(['success' => false, 'message' => 'Please try again.'], 422);
            return;
        }

        $name    = trim((string) ($_POST['name'] ?? ''));
        $email   = trim((string) ($_POST['email'] ?? ''));
        $subject = trim((string) ($_POST['subject'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));

        $errors = [];

        if ($name === '' || mb_strlen($name) > 100) {
            $errors['name'] = 'Please enter a valid name.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if ($subject !== '' && mb_strlen($subject) > 200) {
            $errors['subject'] = 'Subject is too long.';
        }
        if ($message === '' || mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
            $errors['message'] = 'Message should be between 10 and 5000 characters.';
        }

        if (!empty($errors)) {
            $this->json(['success' => false, 'message' => 'Please check the form for errors.', 'errors' => $errors], 422);
            return;
        }

        $saved = Message::create([
            'name'    => strip_tags($name),
            'email'   => strip_tags($email),
            'subject' => strip_tags($subject),
            'message' => strip_tags($message),
            'ip'      => $_SERVER['REMOTE_ADDR'] ?? null,
        ]);

        if (!$saved) {
            $this->json(['success' => false, 'message' => 'Something went wrong on our end. Please email me directly instead.'], 500);
            return;
        }

        $this->json(['success' => true, 'message' => 'Thanks! Your message has been sent — I\'ll get back to you soon.']);
    }
}
