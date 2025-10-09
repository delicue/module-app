<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Home' ?></title>
    <link rel="stylesheet" href="css/generated-styles.css">
</head>
<body>
    <header class="bg-slate-800 text-slate-200 p-4 flex flex-grow justify-between">
        <h1 class="text-2xl font-bold"><?= getenv('APP_NAME') ?></h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="/about" class="hover:underline">About</a></li>
                <li><a href="/contact" class="hover:underline">Contact</a></li>
            </ul>
        </nav>
        <div class="flex items-center space-x-4">
            <input type="text" placeholder="Search..." class="px-2 py-1 rounded">
            <button class="bg-cyan-600 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Search</button>
        </div>
    </header>
