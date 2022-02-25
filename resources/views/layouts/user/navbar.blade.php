<nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3">

    <div class="container tw-user-container">
        <!-- Search Panel Start -->
        <div id="search-container" class="tw-search-container">
            <div class="relative max-w-3xl mx-auto px-6">
                <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
                    <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                    </svg>
                </div>
                <input id="search-toggle" type="search" placeholder="Enter search term ('/' to focus)" class="tw-search-input bg-brand-white" onkeyup="updateSearchResults(this.value);">
            </div>
        </div>
        <!-- Right Navbar Side -->
        <div class="tw-navbar-right" id="example-navbar-warning">
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="flex items-center dropdown">
                    <a class="tw-navbar-link" data-bs-toggle="dropdown" href="#" id="dropdownMenuLink">
                        <i class="tw-navbar-link-image leading-lg fas fa-comments"></i>
                        <span class="badge nav-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="flex items-center dropdown">
                    <a class="tw-navbar-link" data-bs-toggle="dropdown" href="#">
                        <i class="tw-navbar-link-image leading-lg fa-regular fa-bell"></i>
                        <span class="badge nav-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- Logout Button -->
                <li class="flex items-center">
                    <a class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold no-underline" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="tw-navbar-link-image fa-solid fa-arrow-right-from-bracket leading-lg">
                        </i>
                        <span class="lg:hidden inline-block ml-2">Share
                        </span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
