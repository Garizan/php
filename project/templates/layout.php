<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Рецепты') ?></title>
    <style>
        :root{
            --bg:#f4f6fb;
            --card:#ffffff;
            --text:#1f2937;
            --muted:#6b7280;
            --primary:#2563eb;
            --primary-hover:#1d4ed8;
            --accent:#10b981;
            --border:#e5e7eb;
        }

        *{ box-sizing:border-box; }

        body{
            margin:0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(180deg, #f8faff 0%, var(--bg) 100%);
            color:var(--text);
        }

        .container{
            max-width: 1000px;
            margin: 32px auto;
            padding: 0 16px;
        }

        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:14px;
            box-shadow: 0 8px 24px rgba(15,23,42,.06);
            padding:20px;
            margin-bottom:18px;
        }

        h1,h2,h3{ margin-top:0; }

        .subtitle{
            color:var(--muted);
            margin-top:-6px;
            margin-bottom:14px;
        }

        .row{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:12px;
        }

        .field{
            display:flex;
            flex-direction:column;
            gap:6px;
            margin-bottom:10px;
        }

        label{
            font-size:14px;
            color:#374151;
            font-weight:600;
        }

        input, textarea, select{
            width:100%;
            border:1px solid var(--border);
            border-radius:10px;
            padding:10px 12px;
            font-size:14px;
            background:#fff;
            outline:none;
            transition:.2s border-color, .2s box-shadow;
        }

        input:focus, textarea:focus, select:focus{
            border-color:#93c5fd;
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }

        textarea{ min-height:95px; resize:vertical; }

        .actions{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-top:8px;
        }

        .btn{
            display:inline-block;
            border:none;
            border-radius:10px;
            padding:10px 14px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            text-decoration:none;
        }

        .btn-primary{
            background:var(--primary);
            color:white;
        }
        .btn-primary:hover{ background:var(--primary-hover); }

        .btn-ghost{
            background:#eef2ff;
            color:#3730a3;
        }

        .sort{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-bottom:12px;
        }

        .sort a{
            text-decoration:none;
            padding:8px 10px;
            border-radius:8px;
            background:#ecfeff;
            color:#0f766e;
            font-weight:600;
            font-size:13px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:10px;
            border:1px solid var(--border);
        }

        th,td{
            padding:10px;
            border-bottom:1px solid var(--border);
            text-align:left;
            font-size:14px;
        }

        th{
            background:#eff6ff;
            color:#1e3a8a;
            font-weight:700;
        }

        tr:nth-child(even) td{ background:#fcfcfd; }

        .top-links{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-bottom:14px;
        }

        .badge{
            background:#ecfdf5;
            color:#065f46;
            border:1px solid #a7f3d0;
            font-size:12px;
            padding:5px 8px;
            border-radius:999px;
        }

        @media (max-width: 760px){
            .row{ grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
<div class="container">