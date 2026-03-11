# test-project

A basic starter webapp built with **PHP**, **SQLite**, **HTML**, **CSS**, and **JavaScript**.

## Project structure

```
.
├── index.php               # Front controller / main entry point
├── .htaccess               # Apache: URL rewriting & security headers
├── .gitignore
│
├── assets/
│   ├── css/
│   │   └── style.css       # Main stylesheet
│   └── js/
│       └── main.js         # Main JavaScript file
│
├── includes/
│   ├── config.php          # App-wide constants (APP_NAME, DB_PATH, DEBUG…)
│   ├── database.php        # Singleton PDO/SQLite wrapper + schema init
│   └── functions.php       # Utility & data-access helpers
│
├── templates/
│   ├── header.php          # Shared page header (opens <body>)
│   └── footer.php          # Shared page footer (closes <body>)
│
└── data/
    └── .gitkeep            # Runtime SQLite database is stored here (gitignored)
```

## Requirements

| Requirement | Version |
|-------------|---------|
| PHP         | ≥ 8.0   |
| Apache      | with `mod_rewrite` and `mod_headers` enabled |
| PHP ext     | `pdo_sqlite` |

## Getting started

1. **Clone the repository.**
2. Point your Apache `DocumentRoot` (or a virtual host) at the project root.
3. Ensure `AllowOverride All` is set so `.htaccess` is respected.
4. Open the site in a browser – the SQLite database is created automatically on the first request.

> For local development you can also use PHP's built-in server:
> ```bash
> php -S localhost:8080
> ```

## Development notes

* Set `DEBUG` to `false` in `includes/config.php` before deploying to production.
* Keep app secrets (e.g. API keys) out of version control – add them to a local `.env` file or server environment variables.
