<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css " rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-5 border-bottom shadow">
    <img src="/images/GSBlogo.png" width="120px" height="75px">
    <h1 class="mt-2 text-primary">Innovons pour la santé de demain</h1>
    <div class="btn-group" role="group">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modification profil</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Déconnexion</button>
        </form>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-flex flex-column flex-shrink-0 p-3 bg-dark shadow">
            <div class="sidebar-sticky">
                <ul class="nav nav-pills flex-column">
                    @yield('sidebar')
                </ul>
                <script>
                    // On récupère tous les éléments de la navbar
                    const navItems = document.querySelectorAll('.nav-item');

                    // On ajoute un événement "click" à chaque élément
                    navItems.forEach(item => {
                        item.addEventListener('click', () => {
                            // On enlève la classe "active" des autres éléments
                            navItems.forEach(navItem => navItem.classList.remove('active'));

                            // On ajoute la classe "active" à l'élément cliqué
                            item.classList.add('active');
                        });
                    });
                </script>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
    </div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

</body>
</body>
</html>

