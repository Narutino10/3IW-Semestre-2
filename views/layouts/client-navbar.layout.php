<header>
        <div class="container">
           
            <div class="navbar">
                <ul>
                    <li><a href="/client/dashboard" class="<?=Router::currentRoute('client/dashboard') ? 'active' : ''?>">Accueil</a></li>
                    <li><a href="/client/terrain" class="<?=Router::currentRoute('client/terrain') ? 'activenav' : ''?>">Location terrain</a></li>
                    <li><a href="/client/stats" class="<?=Router::currentRoute('client/stats') ? 'activenav' : ''?>">Statistiques complètes</a></li>
                    <li><a href="/client/all-blogs" class="<?=Router::currentRoute('client/all-blogs') ? 'activenav' : ''?>">Articles</a></li>
                    <li><a href="/client/land-rentals" class="<?=Router::currentRoute('client/land-rentals') ? 'activenav' : ''?>">Prochaine location</a></li>
                    <li><a href="/logout">Déconnexion</a></li>

                </ul>
            </div>
        </div>
    </header>

    