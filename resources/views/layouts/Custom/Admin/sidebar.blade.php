<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{ route('/') }}"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('/') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{route('admin.dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span>Dashboard</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('admin.budgets.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-social') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-social') }}"></use>
                            </svg><span>Budgets</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('admin.budgets.requests.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-form') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"></use>
                            </svg><span>Additional Budgets </span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('admin.pdf') }}"
                            target="_self">
                            <i data-feather="file"></i>
                            <span>Reporting </span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('admin.analytics') }}" target="_self">
                            <i data-feather="bar-chart"></i>
                            <span>Analytics </span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('travel.index') }}"
                            target="_self">
                            <i data-feather="navigation-2"></i>
                            <span>Travel Requests </span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('travel-expense.index') }}"
                            target="_self">
                            <i data-feather="pie-chart"></i>
                            <span>Monitor Travel Expenses </span></a></li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
