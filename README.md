# Ade Dian Sukmana — Portfolio

Personal portfolio website for **Ade Dian Sukmana** — Web Developer & UI Designer, Surabaya,
Indonesia. Built as a native PHP MVC application (no framework), with a MySQL database, a
custom dark/premium design system, and vanilla JavaScript for animation and interaction.

## Tech stack

- **Backend:** PHP Native (no Laravel/CodeIgniter/Symfony), simple front-controller + MVC
- **Database:** MySQL, accessed through PDO with prepared statements
- **Frontend:** HTML5, custom CSS (no Bootstrap dependency on the public site), vanilla JS
  (`IntersectionObserver`, `requestAnimationFrame`, CSS transitions — no animation framework)
- **Fonts:** Inter (body) + Space Grotesk (display), loaded from Google Fonts

The Stok Proyek project uses Bootstrap 5 in its *own* codebase (as described in its case study) —
this portfolio site itself does not depend on Bootstrap.

## Project structure

```
/
├── app/
│   ├── config/config.php          # DB credentials + app settings
│   ├── core/                      # Router, Controller base, Database (PDO), Csrf, Auth, App bootstrap
│   ├── controllers/                # Home, Project, Contact, Admin
│   ├── models/                     # Project, Experience, Skill, Message, User
│   ├── views/
│   │   ├── layouts/                 # header/footer shell (public site)
│   │   ├── partials/                # hero, about, experience, projects-list, skills, techstack, academic, contact, footer
│   │   ├── home/index.php           # homepage (assembles all partials)
│   │   ├── projects/show.php        # project case study page
│   │   ├── admin/                   # admin panel views
│   │   └── errors/404.php
│   └── helpers/functions.php       # e(), asset(), base_url(), tags_to_array(), lines_to_array()
├── public/                         # Web root (point your vhost here, or use the root .htaccess)
│   ├── index.php                   # front controller
│   ├── .htaccess
│   └── assets/{css,js,images,icons,fonts}
├── database/
│   ├── schema.sql                  # tables + seed data (verified info only)
│   └── create_admin.php            # CLI script to create your first admin login
├── storage/logs/
└── .htaccess                       # forwards requests to /public (for plain htdocs installs)
```

## Local setup (XAMPP / Windows)

1. **Copy the project** into `C:\xampp\htdocs\web_Portofolio` (already done if you're reading this
   from there).

2. **Create the database.** Open phpMyAdmin or the `mysql` CLI and import the schema:

   ```bash
   C:\xampp\mysql\bin\mysql.exe -u root --default-character-set=utf8mb4 < database/schema.sql
   ```

   This creates the `portfolio_ade` database, all tables, and seeds it with the real
   profile/experience/skills/projects data described in the brief.

   > **Important:** the `--default-character-set=utf8mb4` flag is required. Without it, the
   > `mysql` client on Windows/XAMPP defaults to `latin1` for the import session and will corrupt
   > multi-byte characters (e.g. the em dash `—` in experience entries) into mojibake.

3. **Configure the database connection** in `app/config/config.php` if your MySQL credentials
   differ from the XAMPP defaults (`root` / empty password).

4. **Start Apache + MySQL** from the XAMPP control panel.

5. **Open the site:**

   ```
   http://localhost/web_Portofolio/
   ```

   The root `.htaccess` forwards every request into `public/`. If you'd rather point a virtual
   host directly at the `public/` folder, that works too — `base_url()` adapts automatically.

6. **Create your admin login** (optional, for `/admin`):

   ```bash
   C:\xampp\php\php.exe database/create_admin.php "Ade Dian Sukmana" you@example.com "a-strong-password"
   ```

   Then visit `http://localhost/web_Portofolio/admin/login`.

## How to update content

Everything content-related lives in the database, editable either directly (phpMyAdmin) or
through `/admin`:

- **Projects** — `/admin/projects` (create, edit, delete). Fields map directly to the case-study
  page: overview, challenge, approach, solution, result, technologies, key features.
- **Messages** — `/admin/messages` shows contact form submissions.
- **Profile / socials** — the `settings` table (`email`, `linkedin`, `github`, `location`, etc.),
  and the hard-coded contact links in `app/views/partials/contact.php` and
  `app/views/partials/footer.php` if you'd rather not wire those to `settings` yet.
- **Experience & Skills** — currently seeded via `database/schema.sql`; there's no admin UI for
  these yet (kept out of scope to avoid over-building an admin panel for a personal site with
  low edit frequency). Edit the `experiences` / `skills` tables directly, or extend
  `AdminController` following the same pattern as `projects`. The skills section shows a
  progress bar per skill driven by `skills.level` (0–100) — this is a **self-rated proficiency
  estimate**, not a verified metric, and the section copy says so; adjust the numbers in the DB
  to match your own honest assessment.

### Adding project screenshots

Drop images into `public/assets/images/projects/`, then either:

- set a project's `thumbnail` field (via `/admin/projects` or directly in the DB) to
  `/assets/images/projects/your-file.jpg`, and/or
- insert rows into `project_images` (`project_id`, `image_path`, `alt_text`, `sort_order`) to
  populate the case-study gallery + lightbox.

Until screenshots are added, the site shows clearly-labeled placeholder panels instead of a
guessed/generic image — no dependency on stock photography.

## Security notes

- Passwords are hashed with `password_hash()` / verified with `password_verify()` — never stored
  in plaintext.
- All database queries use PDO prepared statements (no string-concatenated SQL).
- The contact form is protected by a CSRF token, a honeypot field, a minimum-time-on-page check,
  and server-side validation/sanitization — it is not a frontend-only form.
- Admin routes require an authenticated session (`Auth::requireLogin()`); login is rate-limited
  per session after repeated failed attempts.
- Output is escaped via `e()` (`htmlspecialchars`) everywhere user-facing content is echoed.

## Design system

- **Background:** `#07070f` / `#0d0d1a` / `#121223` (dark navy-black)
- **Text:** `#f5f5f5` primary, `#a1a1aa` secondary
- **Brand gradient:** violet → blue (`--gradient-brand`), used on the logo mark, primary CTAs,
  the hero name and the avatar monogram
- **Syntax accent palette:** blue/cyan/purple/orange/yellow/green (`--vs-*` variables in
  `variables.css`), used across section labels, skill/tech chips, timeline dots and project tags
  so the page reads as colorful rather than monochrome, without going neon
- **Type:** Space Grotesk (display/mono-ish accents) + Inter (body), max two families
- **Motion:** CSS transitions/keyframes + `IntersectionObserver`-driven scroll reveals, a custom
  cursor (desktop only), magnetic buttons, a project card grid, and a full project case-study
  route per project (`/projects/{slug}`) — not a JS-only modal.
- All animation respects `prefers-reduced-motion`, and the custom cursor is disabled on
  coarse/touch pointers.
- The hero's "photo" is a monogram avatar (gradient circle + "AD"), not a stock photo — there is
  no real photo of Ade in this repo. Swap `.hero__avatar-blob` in
  `app/views/partials/hero.php` for a real `<img>` once one is available.

## What's accurate vs. placeholder

Per the brief, no experience, project outcome, or credential has been invented. Where a detail
wasn't provided (e.g. project screenshots, a numeric impact metric), the UI shows an explicit,
clearly-labeled placeholder rather than fabricated content.
