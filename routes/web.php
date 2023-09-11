<?php

use Controllers\HomeController;
use Controllers\AboutController;
use Controllers\ProductController;
use Controllers\LoginRegisterController;
use Controllers\AdminDashBoardController;
use Controllers\LandController;
use Controllers\StatsController;
use Controllers\ArticleController;

use Controllers\ClientDashBoardController;
use Controllers\TerrainController;
use Controllers\ClientStatsController;
use Controllers\ClientArticleController;







/* Login Register Routes */
Router::get('', [LoginRegisterController::class, 'index']);
Router::get('logout', [LoginRegisterController::class, 'logout']);
Router::post('login/process', [LoginRegisterController::class, 'processLogin']);
Router::get('register', [LoginRegisterController::class, 'register']);
Router::post('register/process', [LoginRegisterController::class, 'processRegister']);
Router::get('forgot-password', [LoginRegisterController::class, 'forgotPassword']);
Router::get('reset-password', [LoginRegisterController::class, 'resetPassword']);
Router::get('verify-reset-password', [LoginRegisterController::class, 'verifyResetPassword']);
Router::post('reset-password/sendemail', [LoginRegisterController::class, 'sendEmailResetPassword']);
Router::post('reset-password/process', [LoginRegisterController::class, 'processResetPassword']);
Router::get('account-activate', [LoginRegisterController::class, 'activateAccount']);
Router::get('welcome', [LoginRegisterController::class, 'welcome']);
/* Login Register Routes */


Router::get('admin/dashboard', [AdminDashBoardController::class, 'index']);
Router::get('admin/add-land', [LandController::class, 'index']);
Router::post('admin/add-land/process', [LandController::class, 'processAddLand']);
Router::get('admin/current-rentals', [LandController::class, 'currentRentals']);


Router::get('admin/register-user', [LoginRegisterController::class, 'registerUser']);
Router::post('admin/register-user/process', [LoginRegisterController::class, 'processRegister']);


/* Article Routes */
Router::get('admin/all-blogs', [ArticleController::class, 'index']);
Router::get('admin/add-blog', [ArticleController::class, 'addBlog']);
Router::post('admin/add-blog/process', [ArticleController::class, 'processAddBlog']);
Router::get('admin/edit-blog', [ArticleController::class, 'editBlog']);
Router::post('admin/edit-blog/process', [ArticleController::class, 'processEditBlog']);
Router::get('admin/show-blog', [ArticleController::class, 'showBlog']);
Router::get('admin/add-category', [ArticleController::class, 'addCategory']);
Router::post('admin/add-category/process', [ArticleController::class, 'processAddCategory']);
/* Article Routes */

/* Admin Stats Routes */
Router::get('admin/stats', [StatsController::class, 'index']);
Router::post('admin/stats/get-joueur-details', [StatsController::class, 'getJoueurDetails']);
/* Admin Stats Routes */


Router::get('client/dashboard', [ClientDashBoardController::class, 'index']);
Router::get('client/terrain', [TerrainController::class, 'index']);
Router::get('client/reserve-terrain', [TerrainController::class, 'reserve']);
Router::post('client/reserve-terrain/process', [TerrainController::class, 'processReserve']);
Router::get('client/land-rentals', [TerrainController::class, 'clientCurrentRentals']);

Router::get('client/stats', [ClientStatsController::class, 'index']);
Router::get('client/all-blogs', [ClientArticleController::class, 'index']);
Router::get('client/show-blog', [ClientArticleController::class, 'showBlog']);




