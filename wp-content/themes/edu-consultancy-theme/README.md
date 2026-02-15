# Edu Consultancy Theme

Elementor-ready WordPress theme for education & migration consultancy sites, with a full job portal (Jobs CPT, applications, dashboards).

## Contents

- **`style.css`** – Theme header, design tokens (CSS variables), base body/typography
- **`assets/css/theme.css`** – Layout and components (header, footer, job search, job cards, single job, related jobs carousel, application form, Find Jobs hero, Elementor carousel)
- **`inc/`**
  - **`jobs.php`** – Jobs CPT, taxonomies (category, location, type, experience level), meta boxes, excerpt length/more (10 words, " ...")
  - **`job-search.php`** – Shortcodes `[edu_job_search]`, `[edu_job_grid]`; filter bar and results
  - **`applications.php`** – Job applications CPT, apply form shortcode `[edu_job_apply_form]`, AJAX submit, email (required), CV upload
  - **`dashboards.php`** – Job seeker and employer dashboard shortcodes
  - **`roles.php`** – Job Seeker and Employer roles and capabilities
  - **`elementor-widgets.php`** – Registers Elementor widgets
  - **`elementor/`** – Widget classes (Job Grid, Featured Jobs, Job Search, Apply Button, Company Card, Hero Jobs, **Jobs Grid Carousel**)
- **`template-parts/content-job.php`** – Job card markup (featured block, title, meta, excerpt, CTA)
- **`archive-jobs.php`** – Find Jobs archive with hero (breadcrumb, bg image) and job search
- **`single-jobs.php`** – Single job layout, overview sidebar, apply form, similar jobs carousel

## Elementor widgets

| Widget | Purpose |
|--------|--------|
| Job Grid (Edu) | Grid of jobs (shortcode wrapper) |
| Featured Jobs (Edu) | Featured-only job grid |
| Job Search (Edu) | Search/filter form and results |
| Apply Button (Edu) | Apply CTA / form toggle |
| Company Card (Edu) | Company display |
| Hero Jobs Slider (Edu) | Hero with job ticker |
| **Jobs Grid Carousel (Edu)** | Carousel of job cards (e.g. featured), 3–6 per slide, with **Style** tab (title, card title/text/meta, pagination typography & colors) |

## Shortcodes

- `[edu_job_search per_page="6"]` – Find Jobs filter bar + results
- `[edu_job_grid per_page="6" featured_only="no"]` – Plain job grid
- `[edu_job_apply_form]` – Apply form (use on single job page; requires login)
- `[edu_job_seeker_dashboard]` – Job seeker dashboard
- `[edu_employer_dashboard]` – Employer dashboard

## Text domain

`edu-consultancy` — use for all translatable strings.

## Version

1.0.0
