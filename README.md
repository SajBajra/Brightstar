# Brightstar

WordPress site with **Edu Consultancy Theme** — education & migration consultancy with a job portal.

## Requirements

- **PHP** 7.4+ (8.x recommended)
- **MySQL** 5.6+ / MariaDB 10.1+
- **WordPress** 5.9+
- **Elementor** (optional, for page building and theme widgets)

## Features

- **Jobs** – Custom post type with categories, locations, job types, experience levels
- **Find Jobs** – Archive page with hero, breadcrumb, filters (keyword, category, location, type, experience), pagination
- **Single Job** – Job details, overview sidebar, apply form, similar jobs carousel
- **Applications** – Logged-in users can apply with cover letter, CV upload, email (required), optional portfolio URL
- **Roles** – Job Seeker, Employer; employers can publish jobs and manage applications
- **Elementor widgets** – Job Grid, Featured Jobs, Job Search, Apply Button, Company Card, Hero Jobs Slider, **Jobs Grid Carousel** (featured jobs carousel with style options)
- **Dashboards** – Job seeker (profile, my applications), employer (applications list, status updates)

## Theme: Edu Consultancy

- **Location:** `wp-content/themes/edu-consultancy-theme/`
- Elementor-ready; works with or without Elementor Theme Builder
- Custom CSS in `assets/css/theme.css`
- Job cards use 10-word excerpt and " ..." globally

### Elementor – Jobs Grid Carousel

- Add widget **Jobs Grid Carousel (Edu)** to any page
- **Content:** Section title, number of jobs, jobs per slide (1–6), featured only (default: yes), category/type slug, order by
- **Style:** Section title (typography, color); Job cards (title typography/color, text typography/color, meta color); Pagination (typography, text color, hover/current color)

## Installation

1. Ensure WordPress is installed (see [readme.html](readme.html) for WordPress installation).
2. Activate the theme **Edu Consultancy Theme** under Appearance → Themes.
3. (Optional) Install and activate Elementor for widgets and page building.
4. Create pages as needed; use the **Job Search** template for a Find Jobs–style page, or use Elementor and the job widgets.

## Jobs archive

- **URL:** `/jobs/` (post type archive)
- Hero section with breadcrumb (Home / Find Jobs) and background image
- Filters and results use shortcode `[edu_job_search]` (e.g. 6 per page)

## License

WordPress and the theme are GPL v2 or later.
