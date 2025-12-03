<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Management</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        nav {
            background: #eee;
            padding: 10px;
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            background: #ddd;
            color: black;
            border-radius: 4px;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        form {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 400px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <nav>
        <a href="index.php?entity=anggota">Anggota</a>
        <a href="index.php?entity=kategori">Kategori</a>
        <a href="index.php?entity=buku">Buku</a>
        <a href="index.php?entity=peminjaman">Peminjaman</a>
    </nav>

    <hr>
