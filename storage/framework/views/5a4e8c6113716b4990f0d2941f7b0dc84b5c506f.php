<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <?php echo config('app.name', trans('titles.app')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only"><?php echo trans('titles.toggleNav'); ?></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav mr-auto">
                <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo trans('titles.adminDropdownNav'); ?>

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item <?php echo e(Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null); ?>" href="<?php echo e(url('/users')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminUserList'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('users/create') ? 'active' : null); ?>" href="<?php echo e(url('/users/create')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminNewUser'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('themes','themes/create') ? 'active' : null); ?>" href="<?php echo e(url('/themes')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminThemesList'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('logs') ? 'active' : null); ?>" href="<?php echo e(url('/logs')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminLogs'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('activity') ? 'active' : null); ?>" href="<?php echo e(url('/activity')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminActivity'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('phpinfo') ? 'active' : null); ?>" href="<?php echo e(url('/phpinfo')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminPHP'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('routes') ? 'active' : null); ?>" href="<?php echo e(url('/routes')); ?>">
                                <?php echo app('translator')->getFromJson('titles.adminRoutes'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo e(Request::is('active-users') ? 'active' : null); ?>" href="<?php echo e(url('/active-users')); ?>">
                                <?php echo app('translator')->getFromJson('titles.activeUsers'); ?>
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                
                <?php if(auth()->guard()->guest()): ?>
                    <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(trans('titles.login')); ?></a></li>
                    <li><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(trans('titles.register')); ?></a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php if((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1): ?>
                                <img src="<?php echo e(Auth::user()->profile->avatar); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="user-avatar-nav">
                            <?php else: ?>
                                <div class="user-avatar-nav"></div>
                            <?php endif; ?>
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item <?php echo e(Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null); ?>" href="<?php echo e(url('/profile/'.Auth::user()->name)); ?>">
                                <?php echo app('translator')->getFromJson('titles.profile'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
