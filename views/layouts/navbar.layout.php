<header>
        <div class="container">
           
            <div class="navbar">
                <ul>
                    <li><a href="/admin/dashboard" class="<?=Router::currentRoute('admin/dashboard') ? 'active' : ''?>">Accueil</a></li>
                    <li><a href="/admin/add-land" class="<?=Router::currentRoute('admin/add-land') ? 'activenav' : ''?>">Terrains</a></li>
                    <li><a href="/admin/stats" class="<?=Router::currentRoute('/admin/stats') ? 'activenav' : ''?>">Statistiques complètes</a></li>
                    <li><a href="/admin/current-rentals" class="<?=Router::currentRoute('admin/current-rentals') ? 'activenav' : ''?>">Locations en cours</a></li>
                    <li><a href="/admin/all-blogs" class="<?=Router::currentRoute('admin/all-blogs') ? 'activenav' : ''?>">Articles</a></li>
                    <li><a href="/logout">Déconnexion</a></li>
                    <li><a href="/admin/register-user" class="<?=Router::currentRoute('admin/register-user') ? 'activenav' : ''?>">New Admin</a></li>
                </ul>
            </div>
        </div>
    </header>

    