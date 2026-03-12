<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Écoles</title>
    <!-- Utilisation du CDN Tailwind pour le développement rapide -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-4xl mx-auto">
    <header class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Nos Écoles</h1>
        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            Ajouter une école
        </a>
    </header>

    <main class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nom de l'école</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Localisation</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            <!-- Exemple de ligne statique -->
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-800">École Primaire "L'Avenir"</td>
                <td class="px-6 py-4 text-gray-600">Paris, France</td>
                <td class="px-6 py-4">
                    <a href="#" class="text-blue-500 hover:underline mr-3">Modifier</a>
                    <button class="text-red-500 hover:underline">Supprimer</button>
                </td>
            </tr>

            <!-- Note : Plus tard, tu utiliseras @foreach($schools as $school) ici -->
            </tbody>
        </table>
    </main>

    <footer class="mt-8 text-center text-gray-500 text-sm">
        Géré avec Laravel &hearts;
    </footer>
</div>

</body>
</html>
