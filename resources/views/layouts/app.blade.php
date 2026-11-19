<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portal Berita') — Nusa News</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <meta name="description" content="Nusa News — portal berita sederhana berbasis Laravel.">
    <meta property="og:image" content="{{ asset('images/og-cover.svg') }}">
    <style>
        :root {
            --bg: #f4f6fb;
            --surface: #ffffff;
            --border: #e5e9f0;
            --text: #0f1729;
            --text-soft: #475467;
            --muted: #6b778c;
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-soft: #eef0fe;
            --success-bg: #ecfdf5;
            --success-border: #a7f3d0;
            --success-text: #047857;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #b91c1c;
            --radius: 14px;
            --shadow-sm: 0 1px 2px rgba(15,23,42,.06);
            --shadow-md: 0 4px 12px rgba(15,23,42,.07);
            --shadow-lg: 0 12px 28px rgba(15,23,42,.10);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 15px;
            line-height: 1.65;
            color: var(--text);
            background: var(--bg);
            background-image:
                radial-gradient(900px 380px at 12% -8%, rgba(79,70,229,.10), transparent 60%),
                radial-gradient(760px 320px at 92% 0%, rgba(14,165,233,.09), transparent 62%);
            background-repeat: no-repeat;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        a { color: var(--primary); text-decoration: none; transition: color .15s; }
        a:hover { color: var(--primary-dark); }

        .container { max-width: 1060px; margin: 0 auto; padding: 0 22px 56px; }

        /* halaman auth: pusatkan kartu secara vertikal */
        body.auth-page .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        body.auth-page main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0 30px;
        }
        body.auth-page main > .card { width: 100%; }
        body.auth-page footer { margin-top: 0; }

        /* ================= NAVBAR ================= */
        .nav-wrap {
            position: sticky;
            top: 12px;
            z-index: 50;
            margin: 14px 0 34px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 3px;
            flex-wrap: wrap;
            padding: 7px 9px 7px 13px;
            background: rgba(255,255,255,.78);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(226,232,240,.9);
            border-radius: 999px;
            box-shadow: 0 2px 6px rgba(15,23,42,.05), 0 10px 24px -8px rgba(15,23,42,.12);
            transition: box-shadow .25s, background .25s;
        }
        .nav:hover { box-shadow: 0 2px 6px rgba(15,23,42,.06), 0 14px 30px -10px rgba(79,70,229,.2); }

        .nav .brand {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-weight: 800;
            font-size: 15px;
            letter-spacing: -.35px;
            color: var(--text);
            padding-right: 12px;
            margin-right: 4px;
            border-right: 1px solid var(--border);
        }
        .nav .brand:hover { color: var(--text); }

        .nav .brand .mark {
            position: relative;
            width: 26px; height: 26px;
            border-radius: 8px;
            background: transparent;
            box-shadow: 0 3px 9px rgba(79,70,229,.28);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: none;
            overflow: hidden;
        }
        .nav .brand .mark svg { width: 14px; height: 14px; display: block; }
        .nav .brand .mark img { width: 18px; height: 18px; display: block; border-radius: 5px; }
        .nav .brand .mark::after {
            content: "";
            position: absolute; inset: 0;
            border-radius: 8px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.35);
        }

        .nav .brand .wordmark { display: flex; flex-direction: column; line-height: 1.08; }
        .nav .brand .wordmark small {
            font-size: 8.5px;
            font-weight: 650;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .nav a.navlink {
            position: relative;
            color: var(--text-soft);
            font-weight: 550;
            font-size: 13.5px;
            padding: 6px 12px;
            border-radius: 999px;
            transition: color .18s, background .18s;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2px;
            flex-wrap: wrap;
            min-width: 0;
        }
        .nav a.navlink:hover { color: var(--text); background: #f2f4f9; }
        .nav a.navlink.active {
            color: #fff;
            font-weight: 650;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            box-shadow: 0 4px 12px rgba(79,70,229,.35);
        }
        .nav a.navlink.active::before {
            content: "";
            position: absolute; inset: 0;
            border-radius: 999px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.25);
        }

        .nav .right { margin-left: auto; display: flex; align-items: center; gap: 9px; }

        .nav .greeting {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
            padding: 5px 12px 5px 5px;
            border-radius: 999px;
            background: #f7f8fc;
            border: 1px solid var(--border);
        }

        .avatar {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #0ea5e9);
            color: #fff;
            font-size: 11.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: none;
            letter-spacing: -.2px;
            box-shadow: 0 2px 6px rgba(79,70,229,.3);
        }

        .nav .greeting strong { color: var(--text); font-weight: 650; font-size: 13px; }


        /* ================= CARD ================= */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: var(--shadow-sm);
        }

        .card + .card, .card + section .card, section + section { margin-top: 20px; }

        .row {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        /* ================= TIPOGRAFI ================= */
        h1, h2, h3, h4 { line-height: 1.28; color: var(--text); letter-spacing: -.4px; }
        h1 { font-size: 30px; font-weight: 800; margin: 0 0 14px; }
        h2 { font-size: 23px; font-weight: 750; margin: 0 0 14px; }
        h3 { font-size: 17px; font-weight: 700; margin: 0 0 12px; }
        h4 { font-size: 15.5px; font-weight: 650; margin: 0 0 6px; }

        code {
            background: #f1f3f9;
            color: #4c1d95;
            padding: 2px 7px;
            border-radius: 6px;
            font-size: .88em;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
        }

        .muted { color: var(--muted); font-size: 14px; }
        .lead { font-size: 16px; color: var(--text-soft); }

        /* ================= HERO ================= */
        .hero {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 45%, #0ea5e9 100%);
            border-radius: 18px;
            padding: 28px 30px;
            color: #fff;
            box-shadow: 0 14px 34px -14px rgba(79,70,229,.42);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 88% 12%, rgba(255,255,255,.20), transparent 42%),
                radial-gradient(circle at 12% 92%, rgba(14,165,233,.32), transparent 45%);
            z-index: -1;
        }
        .hero::after {
            content: "";
            position: absolute;
            right: -70px; top: -70px;
            width: 240px; height: 240px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,.16);
            box-shadow: 0 0 0 32px rgba(255,255,255,.055), 0 0 0 64px rgba(255,255,255,.035);
            z-index: -1;
        }
        .hero h1, .hero h2 { color: #fff; margin-top: 0; letter-spacing: -.5px; }
        .hero p { color: rgba(255,255,255,.94); margin: 0; font-size: 14px; line-height: 1.6; max-width: 520px; }
        .hero .muted { color: rgba(255,255,255,.8); }
        .hero a { color: #fff; text-decoration: underline; font-weight: 600; }
        .hero .hero-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 18px; position: relative; z-index: 1; }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.28);
            backdrop-filter: blur(6px);
            margin-bottom: 12px;
        }
        .hero-chip .pulse {
            width: 6px; height: 6px; border-radius: 50%; background: #4ade80;
            box-shadow: 0 0 0 3px rgba(74,222,128,.35);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 3px rgba(74,222,128,.35); }
            50% { box-shadow: 0 0 0 6px rgba(74,222,128,.12); }
        }

        .hero-stats {
            display: flex;
            gap: 26px;
            flex-wrap: wrap;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,.2);
            position: relative;
            z-index: 1;
        }
        .hero-stats .st-num { font-size: 18px; font-weight: 750; letter-spacing: -.4px; line-height: 1.15; }
        .hero-stats .st-lbl { font-size: 10.5px; color: rgba(255,255,255,.72); text-transform: uppercase; letter-spacing: .07em; font-weight: 650; }

        /* ================= PESAN ================= */
        .flash, .error {
            padding: 13px 17px;
            border-radius: 11px;
            margin: 0 0 18px;
            font-size: 14px;
            border: 1px solid;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }
        .flash { background: var(--success-bg); border-color: var(--success-border); color: var(--success-text); font-weight: 550; }
        .error { background: var(--danger-bg); border-color: var(--danger-border); color: var(--danger-text); display: block; }
        .error ul { margin: 8px 0 0; padding-left: 20px; }

        /* ================= TOMBOL ================= */
        button, .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font: inherit;
            font-weight: 650;
            font-size: 14px;
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid var(--primary);
            background: var(--primary);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(79,70,229,.25);
            transition: background .16s, border-color .16s, transform .12s, box-shadow .16s;
        }
        button:hover, .btn:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(79,70,229,.28);
        }
        button:active, .btn:active { transform: translateY(0); }

        .btn-ghost {
            background: #fff;
            color: var(--text-soft);
            border-color: var(--border);
            box-shadow: none;
        }
        .btn-ghost:hover { background: #f7f8fc; color: var(--text); border-color: #cfd6e4; box-shadow: var(--shadow-sm); }

        .btn-white {
            background: rgba(255,255,255,.16);
            border-color: rgba(255,255,255,.5);
            color: #fff;
            box-shadow: none;
            backdrop-filter: blur(4px);
        }
        .btn-white:hover { background: rgba(255,255,255,.26); border-color: #fff; color: #fff; }

        .btn-danger {
            background: #fff;
            color: var(--danger-text);
            border-color: var(--danger-border);
            padding: 5px 11px;
            font-size: 13px;
            box-shadow: none;
        }
        .btn-danger:hover { background: var(--danger-bg); border-color: #fca5a5; color: var(--danger-text); transform: none; box-shadow: none; }

        .btn-sm { padding: 5px 11px; font-size: 13px; border-radius: 8px; }

        .btn-pill { border-radius: 999px; padding: 8px 18px; font-size: 13.5px; }
        .nav form.inline button.btn-pill { padding: 7px 15px; font-size: 13px; }

        form.inline { display: inline; }

        /* ================= FORM ================= */
        .form-card { max-width: 560px; }
        .form-card.wide { max-width: 100%; }

        form label {
            display: block;
            font-weight: 650;
            font-size: 13.5px;
            color: var(--text);
            margin: 18px 0 7px;
        }
        form label:first-of-type { margin-top: 0; }

        input[type=text], input[type=url], input[type=email],
        input[type=password], textarea {
            width: 100%;
            padding: 11px 13px;
            font: inherit;
            font-size: 14.5px;
            color: var(--text);
            background: #fcfdff;
            border: 1px solid #dfe4ed;
            border-radius: 10px;
            transition: border-color .16s, box-shadow .16s, background .16s;
        }

        input::placeholder, textarea::placeholder { color: #9aa4b6; }

        input:focus, textarea:focus {
            outline: none;
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79,70,229,.13);
        }

        textarea { resize: vertical; min-height: 150px; line-height: 1.6; }

        .checkbox-row { display: flex; align-items: center; gap: 9px; margin: 16px 0 0; }
        .checkbox-row input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--primary); margin: 0; }
        .checkbox-row label { margin: 0; font-weight: 500; color: var(--text-soft); font-size: 14px; }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .form-hint { font-size: 13px; color: var(--muted); margin: 7px 0 0; }

        .form-footer { margin-top: 18px; font-size: 14px; color: var(--muted); text-align: center; }

        /* ================= DAFTAR ARTIKEL ================= */
        .list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }
        .list-head h2 { margin: 0; }

        .article-list { list-style: none; margin: 8px 0 0; padding: 0; }

        .article-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 15px 12px;
            margin: 0 -12px;
            border-bottom: 1px solid var(--border);
            border-radius: 10px;
            transition: background .16s;
        }
        .article-list li:hover { background: #f8f9fd; }
        .article-list li:last-child { border-bottom: 0; }

        .article-list .title-link { font-weight: 620; font-size: 15.5px; color: var(--text); }
        .article-list .title-link:hover { color: var(--primary); }

        .article-list .byline { font-size: 13px; color: var(--muted); }
        .article-list .actions { margin-left: auto; display: flex; align-items: center; gap: 8px; }

        .badge {
            display: inline-block;
            font-size: 12px;
            font-weight: 650;
            padding: 2px 9px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
        }

        /* ================= KARTU BERITA ================= */
        .news-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            margin-top: 16px;
        }

        .news-card {
            display: flex;
            flex-direction: column;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s, transform .2s, border-color .2s;
            height: 100%;
        }
        .news-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
            border-color: #d6dceb;
        }

        .news-thumb {
            width: 100%;
            height: 148px;
            object-fit: cover;
            display: block;
            background: #eef1f7;
        }

        .news-body { padding: 15px 16px 16px; display: flex; flex-direction: column; flex: 1; }

        .news-title { font-size: 15px; font-weight: 680; margin: 0 0 6px; line-height: 1.38; }
        .news-title a { color: var(--text); }
        .news-title a:hover { color: var(--primary); }

        .news-meta {
            font-size: 12px;
            color: var(--muted);
            margin: 0 0 9px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .news-meta .sep { color: #cbd2e0; }

        .news-excerpt {
            margin: 0 0 12px;
            font-size: 13.5px;
            line-height: 1.6;
            color: var(--text-soft);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more {
            margin-top: auto;
            font-size: 13.5px;
            font-weight: 650;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap .16s;
        }
        .read-more:hover { gap: 8px; }

        /* ================= DETAIL ARTIKEL ================= */
        .article-hero-img {
            width: 100%;
            max-height: 380px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            margin: 18px 0 24px;
            box-shadow: var(--shadow-md);
        }

        .article-body {
            font-size: 15.5px;
            line-height: 1.85;
            color: #26303f;
        }

        .article-footer {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* ================= STATISTIK ================= */
        .dash-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .dash-eyebrow {
            margin: 0;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--primary);
        }

        .stat-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 14px 16px;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .18s, transform .18s, border-color .18s;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: #d6dceb;
        }

        .stat-ico {
            width: 38px; height: 38px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex: none;
        }

        .stat-lbl {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
        }
        .stat-value {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -.8px;
            line-height: 1.15;
            margin: 1px 0 0;
        }
        .stat-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .dash-cols {
            display: grid;
            gap: 18px;
            grid-template-columns: minmax(0, 1.65fr) minmax(0, 1fr);
            margin-top: 18px;
            align-items: start;
        }
        .dash-cols > .card { display: flex; flex-direction: column; height: 100%; }
        @media (max-width: 820px) {
            .dash-cols { grid-template-columns: 1fr; }
        }

        .mini-list { list-style: none; margin: 6px 0 0; padding: 0; }
        .mini-list li {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 0;
            border-bottom: 1px solid var(--border);
        }
        .mini-list li:last-child { border-bottom: 0; padding-bottom: 0; }
        .mini-list img {
            width: 52px; height: 39px;
            object-fit: cover;
            border-radius: 8px;
            flex: none;
            background: #eef1f7;
        }
        .mini-title {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.35;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .mini-title:hover { color: var(--primary); }
        .mini-meta {
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .quick-actions { list-style: none; margin: 0; padding: 0; }
        .quick-actions li + li { margin-top: 7px; }
        .quick-actions a {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13.5px;
            font-weight: 550;
            padding: 8px 11px;
            border-radius: 9px;
            background: #f8f9fd;
            border: 1px solid var(--border);
            color: var(--text-soft);
            transition: background .16s, border-color .16s, color .16s, transform .12s;
        }
        .quick-actions a:hover {
            background: var(--primary-soft);
            border-color: #c7d2fe;
            color: var(--primary-dark);
            transform: translateX(2px);
        }
        .qa-ico {
            width: 20px; height: 20px;
            border-radius: 6px;
            background: #fff;
            border: 1px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--primary);
            flex: none;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        .info-row:last-child { border-bottom: 0; padding-bottom: 0; }
        .info-lbl { color: var(--muted); }
        .info-val { font-weight: 600; text-align: right; word-break: break-word; }

        /* ================= PAGINATION ================= */
        .pagination { display: flex; gap: 7px; list-style: none; padding: 0; margin: 26px 0 0; flex-wrap: wrap; }

        .pagination li a, .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            font-size: 14px;
            font-weight: 550;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            color: var(--text-soft);
            transition: background .16s, border-color .16s, color .16s;
        }
        .pagination li a:hover { background: #f4f6fb; color: var(--text); border-color: #cfd6e4; }

        .pagination li.active span {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(79,70,229,.3);
        }

        .pagination li.disabled span { color: #c3cad8; background: #fafbfd; }
        .pagination svg { width: 16px; height: 16px; }

        /* ================= FOOTER ================= */
        footer {
            margin-top: 52px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 13px;
            color: var(--muted);
        }

        /* ================= RESPONSIF ================= */
        @media (max-width: 680px) {
            .container { padding: 0 15px 40px; }

            /* nav jadi dua baris rapi: brand + aksi di atas, menu di bawah */
            .nav-wrap { top: 8px; margin: 10px 0 24px; }
            .nav {
                padding: 8px 10px;
                border-radius: 16px;
                row-gap: 6px;
            }
            .nav .brand {
                border-right: 0;
                padding-right: 0;
                margin-right: 0;
                flex: 1;
                min-width: 0;
            }
            .nav .right {
                margin-left: auto;
                gap: 6px;
            }
            .nav .greeting { display: none; }
            .nav a.navlink {
                font-size: 13px;
                padding: 5px 10px;
            }
            /* mobile: brand + aksi di baris 1, menu turun ke baris 2 */
            .nav { row-gap: 4px; }
            .nav .brand { order: 0; flex: 1 1 auto; }
            .nav .right { order: 1; margin-left: auto; gap: 6px; }
            .nav-menu {
                order: 2;
                flex: 1 0 100%;
                gap: 3px;
                padding-top: 6px;
                margin-top: 2px;
                border-top: 1px solid var(--border);
            }
            .nav-menu .navlink {
                flex: 1;
                text-align: center;
                font-size: 12.5px;
                padding: 6px 4px;
                background: #f4f5fa;
                border-radius: 8px;
                color: var(--text-soft);
                box-shadow: none;
            }
            .nav-menu .navlink:hover { background: #eceef6; color: var(--text); }
            .nav-menu .navlink.active {
                background: var(--primary-soft);
                color: var(--primary-dark);
                font-weight: 650;
                box-shadow: none;
            }
            .nav-menu .navlink.active::before { display: none; }

            .hero { padding: 22px 20px; border-radius: 14px; }
            .hero h1 { font-size: 23px !important; }
            .hero p { font-size: 13px; }
            .hero-stats { gap: 18px; margin-top: 16px; padding-top: 14px; }
            .hero-stats .st-num { font-size: 16px; }
            .hero-stats .st-lbl { font-size: 9.5px; }

            h1 { font-size: 24px; }
            h2 { font-size: 20px; }
            .card { padding: 18px; }
            .news-grid { grid-template-columns: 1fr; }
            .article-list .actions { margin-left: 0; width: 100%; }
            footer { font-size: 12px; }
        }

        @media (max-width: 400px) {
            .nav a.navlink { font-size: 12.5px; padding: 4px 8px; }
            .hero h1 { font-size: 21px !important; }
        }
    </style>
</head>
<body class="@yield('body-class')">
    <div class="container">
        @include('partials.nav')

        <main>
            @yield('content')
        </main>

        <footer>
            <span>Nusa News &middot; Portal Berita Laravel</span>
            <span>&copy; {{ date('Y') }} &middot; Pemrograman Web</span>
        </footer>
    </div>
</body>
</html>
