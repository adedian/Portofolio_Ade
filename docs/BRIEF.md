# Project Brief — Master Prompt

This document is the original brief used to build this portfolio site, kept here for reference
so future changes stay consistent with the intended direction (identity, tone, tech constraints,
and the "no fabricated content" rule).

---

## MASTER PROMPT — BUILD PREMIUM IT PORTFOLIO WEBSITE

**ADE DIAN SUKMANA — WEB DEVELOPER & UI DESIGNER**

Kamu bertindak sebagai: Principal Full-Stack Web Developer, Senior PHP Native Developer, Senior
UI/UX Designer, Creative Web Designer, Motion/Interaction Designer, Front-End Engineer, Back-End
Engineer, Database Architect, SEO Specialist, Web Performance Engineer, Accessibility Specialist,
Technical Portfolio Strategist.

Website ini bukan sekadar CV online — harus terlihat seperti portfolio developer profesional
kelas internasional: premium, sophisticated, immersive, dark, editorial, teknikal, dan
menunjukkan kemampuan teknis melalui website itu sendiri.

### Tujuan utama

Recruiter/HR/client yang membuka website harus langsung memahami: siapa Ade, bidangnya, skill
teknis, project yang pernah dikerjakan, pengalaman profesional, cara kerja, kemampuan web dev,
UI/UX, kemampuan membangun sistem, dan cara menghubungi.

### Identitas

- **Nama:** Ade Dian Sukmana
- **Identity:** Web Developer & UI Designer (alt: IT System & Operations Management Professional)
- **Lokasi:** Surabaya, Indonesia
- **Pendidikan:** S1 Informatika / Computer Science, Telkom University Surabaya, 2021–2025
- **LinkedIn:** https://id.linkedin.com/in/ade-dian-sukmana (source of truth for professional
  info — no invented experience, employer, certification, or achievement)

### Experience (verified only)

- **PT Hexa Multi Energi** — IT Staff & Web Developer, Jan 2026–Present, Surabaya. Web dev &
  maintenance, WordPress, PHP, UI design (Figma), website security (SSL), cPanel/hPanel, backup
  management, IT system monitoring, troubleshooting.
- **Metropolis Apartment** — UI/UX Designer / Intern, Jul–Aug 2024. UI/UX design, Figma, internal
  application design in a technical/engineering environment.
- **Himpunan Mahasiswa Informatika (Telkom University)** — Department of External Affairs,
  Sep 2022–Sep 2023 (organization, presented as part of the journey, not a job).

### Projects

1. **PT Megah Restu Bumi** — Corporate Website (PHP, HTML, CSS, JS, MySQL, WordPress). Corporate
   site for a stretch film / plastic wrapping company — corporate, industrial, premium tone.
2. **Dashboard Kontrol Stok Proyek** — PT Hexa Multi Energi (PHP Native, MySQL, PDO, Bootstrap 5,
   AJAX). Internal system: project inventory, PO, goods in/out, stock opname, invoice, kas/bank,
   reporting, master data, role-based access, audit tracking.
3. **Real-Time Hat & Helmet Detection for ATM CCTV** — academic/thesis project (Python, YOLOv5,
   Deep Learning, OpenCV). Detection-only scope — explicitly **not** face recognition and **not**
   automated blocking/punishment; assists human security monitoring.

### Hard constraints

- **Backend must be PHP Native** — no Laravel/CodeIgniter/Symfony. MySQL via PDO, prepared
  statements only.
- **Frontend:** HTML5, custom CSS (avoid looking like a Bootstrap template), vanilla JS
  (`IntersectionObserver`, CSS transitions/keyframes). GSAP/heavy libraries only if they add real
  value — avoid dependencies added purely to look impressive.
- **Visual direction:** dark (`#050505`/`#0d0d0d`/`#111111`), large typography, generous
  whitespace, subtle accent (electric blue/cyan/violet) — explicitly *not* neon/cyberpunk/gaming,
  not a generic AI-generated template look (no skill percentage bars, no excessive
  glassmorphism/gradients/rounded cards).
- **Content accuracy:** never fabricate experience, companies, projects, achievements, awards,
  clients, certifications, metrics, or testimonials. Missing data (e.g. screenshots) gets an
  explicit, clearly-labeled placeholder instead of a guess.
- **Case studies are full pages** (`/projects/{slug}`), not JS-only modals: hero → overview →
  problem → approach → solution → technology → features → result → gallery → next project.
- **Admin/CMS is optional** but implemented here at a basic level (PHP Native, `password_hash`/
  `password_verify`, CSRF-protected) for managing projects and reading contact messages.
- Security: PDO prepared statements, CSRF tokens, XSS output escaping, hashed passwords, input
  validation/sanitization, honeypot + timing check on the contact form.
- Accessibility: semantic HTML, keyboard navigation, focus states, alt text, sufficient contrast,
  `prefers-reduced-motion` support.
- Fully responsive: 1440/1280/1024/768/430/414/390/375/360, mobile UX redesigned (not just a
  shrunk desktop layout), custom cursor and heavier motion disabled on touch/coarse pointers and
  when reduced motion is requested.

See [README.md](../README.md) for the technical implementation, local setup, and how to update
content going forward.
