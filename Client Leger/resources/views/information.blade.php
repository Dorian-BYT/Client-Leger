<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de bienvenue - GSB</title>
    <!-- Liens vers les fichiers CSS Bootstrap -->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css " rel="stylesheet">

    <!-- Fonts -->

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
    </style>


</head>
<body>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <a href="{{ route('accueil') }}" class="mt-3 ml-4  text-gray-900 underline">Accueil</a>
    </div>

    <div class="mt-8 bg-white max-w-6xl">
        <div class="grid">
            <div class="p-6 md:w-auto border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-center">
                    <h2 class="text-center border-l border-r px-2 underline">Galaxy Swiss Bourdin</h2> <!--Ajout des classes "text-center", "border-l", "border-r" et "px-2"-->
                </div>
                <div class="border-l border-r px-2 py-4"> <!--Ajout des classes "border-l", "border-r", "px-2" et "py-4"-->
                    <div>
                        <br><br><strong>Le secteur d'activité</strong>

                        <br><br>Le domaine de l’industrie pharmaceutique est très rentable, avec un fort mouvement de fusions et acquisitions. Au cours des dernières années, les regroupements de laboratoires ont donné naissance à des entités gigantesques qui ont conservé les anciennes structures organisationnelles.

                        <br><br>Des incidents récents liés à des médicaments ou des molécules ayant entraîné des complications médicales ont suscité des critiques à l’encontre d’une partie de l’activité des laboratoires : la visite médicale. Cette dernière est réputée pour être un lieu d’arrangements entre l’industrie et les praticiens, et est souvent considérée comme un terrain d’influence opaque.

                        <br><br><strong>L'entreprise</strong>

                        <br><br>Le laboratoire Galaxy Swiss Bourdin (GSB) est le fruit de la fusion entre le géant américain Galaxy, spécialisé dans le traitement des maladies virales telles que le SIDA et les hépatites, et le conglomérat européen Swiss Bourdin, qui travaille sur des médicaments plus conventionnels. Ce dernier était déjà une fusion de trois petits laboratoires.

                        <br><br>En 2009, les deux géants pharmaceutiques ont uni leurs forces pour créer un leader dans ce secteur industriel. L’entité Galaxy Swiss Bourdin Europe a établi son siège administratif à Paris, en France, alors que le siège social de la multinationale est situé à Philadelphie, en Pennsylvanie, aux États-Unis.

                        <br><br>La France a été choisie comme site pilote pour l’amélioration du suivi de l’activité de visite médicale.

                        <br><br><strong>Réorganisation</strong>

                        <br><br>Une conséquence de cette fusion est la recherche d’une optimisation de l’activité du groupe ainsi constitué, en réalisant des économies d’échelle dans la production et la distribution des médicaments, tout en prenant le meilleur des deux laboratoires sur les produits concurrents. Cela implique une restructuration nécessaire et une vague de licenciements.

                        <br><br>L’entreprise compte actuellement 480 visiteurs médicaux en France métropolitaine, y compris en Corse, et 60 dans les départements et territoires d’outre-mer. Les territoires sont répartis en 6 secteurs géographiques, à savoir Paris-Centre, Sud, Nord, Ouest, Est, et DTOM Caraïbes-Amériques, DTOM Asie-Afrique.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
</body>
</html>
