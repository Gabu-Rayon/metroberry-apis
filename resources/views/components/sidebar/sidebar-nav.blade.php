<nav class="sidebar-nav">
    <ul class="metismenu text-capitalize">

        @if (\Auth::user()->can('view dashboard'))
            @include('components.sidebar.sidebar-item', [
                'isActive' => request()->routeIs('dashboard'),
                'route' => route('dashboard'),
                'icon' => '<i class="fa-solid fa-chart-column"></i>',
                'label' => 'Dashboard',
            ])
        @endif

        @if (\Auth::user()->can('manage users'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Users',
                'icon' => '<i class="fa-solid fa-users"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('manage customers')
                        ? ['label' => 'Employees', 'route' => route('employee')]
                        : null,
                    \Auth::user()->can('manage organisations')
                        ? ['label' => 'Organisations', 'route' => route('organisation')]
                        : null,
                    \Auth::user()->can('manage drivers')
                        ? ['label' => 'Drivers', 'route' => route('driver')]
                        : null,
                    \Auth::user()->can('manage driver licenses')
                        ? ['label' => 'Licenses', 'route' => route('driver.license')]
                        : null,
                    \Auth::user()->can('manage driver psvbadges')
                        ? ['label' => 'PSV Badges', 'route' => route('driver.psvbadge.index')]
                        : null,
                    \Auth::user()->can('show driver performance')
                        ? ['label' => 'Driver Performance', 'route' => route('driver.performance.index')]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage vehicles'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Vehicles',
                'icon' => '<i class="fa-solid fa-car"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('view vehicle')
                        ? ['label' => 'Vehicles', 'route' => route('vehicle')]
                        : null,
                    \Auth::user()->can('manage vehicle insurance')
                        ? ['label' => 'Vehicle Insurances', 'route' => route('vehicle.insurance.index')]
                        : null,
                    \Auth::user()->can('view vehicle inspection certificate')
                        ? [
                            'label' => 'NTSA Inspection Certificates',
                            'route' => route('vehicle.inspection.certificate'),
                        ]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage routes'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Routes',
                'icon' => '<i class="fa-solid fa-route"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('manage routes')
                        ? ['label' => 'Routes', 'route' => route('route.index')]
                        : null,
                    \Auth::user()->can('manage route locations')
                        ? ['label' => 'Route Locations', 'route' => route('route.location.index')]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage trips'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Trips',
                'icon' => '<i class="fa-solid fa-suitcase-rolling"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('view trip')
                        ? ['label' => 'Scheduled Trips', 'route' => route('trip.scheduled')]
                        : null,
                    \Auth::user()->can('view trip')
                        ? ['label' => 'Completed Trips', 'route' => route('trip.completed')]
                        : null,
                    \Auth::user()->can('view trip')
                        ? ['label' => 'Cancelled Trips', 'route' => route('trip.cancelled')]
                        : null,
                    \Auth::user()->can('view trip')
                        ? ['label' => 'Billed Trips', 'route' => route('trip.billed')]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage vehicle insurance company'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Insurance',
                'icon' => '<i class="fa-solid fa-car-burst"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('manage vehicle insurance company')
                        ? ['label' => 'Manage Insurance Company', 'route' => route('vehicle.insurance.company')]
                        : null,
                    \Auth::user()->can('manage vehicle insurance company')
                        ? [
                            'label' => 'Insurance Recurring Period',
                            'route' => route('vehicle.insurance.recurring.period'),
                        ]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage vehicle maintenance'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Maintenance',
                'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('view vehicle maintenance')
                        ? ['label' => 'Maintenance Service', 'route' => route('maintenance.service')]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? ['label' => 'Maintenance Repair', 'route' => route('maintenance.repair')]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? ['label' => 'Service Types', 'route' => route('vehicle.maintenance.service')]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? [
                            'label' => 'Service Categories',
                            'route' => route('vehicle.maintenance.service.categories'),
                        ]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? ['label' => 'Vehicle Parts', 'route' => route('vehicle.maintenance.parts')]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? [
                            'label' => 'Vehicle Part Categories',
                            'route' => route('vehicle.maintenance.parts.category'),
                        ]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? ['label' => 'Repair Types', 'route' => route('vehicle.maintenance.repairs')]
                        : null,
                    \Auth::user()->can('view vehicle maintenance')
                        ? [
                            'label' => 'Repair Categories',
                            'route' => route('vehicle.maintenance.repairs.categories'),
                        ]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage vehicle refueling'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Refueling',
                'icon' => '<i class="fa-solid fa-gas-pump"></i>',
                'subitems' => array_filter([
                    ['label' => 'Fuel Requisition', 'route' => route('refueling.index')],
                    ['label' => 'Fuel Stations', 'route' => route('refueling.station')],
                ]),
            ])
        @endif

        @if (\Auth::user()->can('view report purchase'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Reports',
                'icon' => '<i class="fa-solid fa-file-lines"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('view report employee')
                        ? ['label' => 'Employee Report', 'route' => route('report.employee')]
                        : null,
                    \Auth::user()->can('view report driver')
                        ? ['label' => 'Driver Report', 'route' => route('report.driver')]
                        : null,
                    \Auth::user()->can('view report vehicle')
                        ? ['label' => 'Vehicle Report', 'route' => route('report.vehicle')]
                        : null,
                    \Auth::user()->can('view report vehicle')
                        ? ['label' => 'Trips Report', 'route' => route('report.trips')]
                        : null,
                    \Auth::user()->can('view report maintenance')
                        ? ['label' => 'Service Report', 'route' => route('report.service')]
                        : null,
                    \Auth::user()->can('view report maintenance')
                        ? ['label' => 'Repairs Report', 'route' => route('report.repairs')]
                        : null,
                    \Auth::user()->can('view report maintenance')
                        ? ['label' => 'Fueling Report', 'route' => route('report.refueling')]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage permission'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Role permission',
                'icon' => '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                   <g clip-path="url(#clip0_2128_398)">
                                                                                                                   <path d="M13.6998 15.6349C12.8363 15.6349 11.9923 15.891 11.2743 16.3707C10.5563 16.8505 9.99676 17.5323 9.66632 18.3301C9.33588 19.1278 9.24942 20.0056 9.41787 20.8525C9.58633 21.6994 10.0021 22.4773 10.6127 23.0879C11.2233 23.6985 12.0012 24.1143 12.8481 24.2828C13.695 24.4512 14.5728 24.3648 15.3706 24.0343C16.1683 23.7039 16.8502 23.1443 17.3299 22.4263C17.8096 21.7084 18.0657 20.8643 18.0657 20.0008C18.0596 18.8448 17.5977 17.7378 16.7803 16.9203C15.9628 16.1029 14.8559 15.641 13.6998 15.6349ZM14.4658 20.3838C14.347 20.3808 14.2299 20.3548 14.1211 20.3072L12.4743 21.9539C12.382 22.0454 12.2594 22.0998 12.1297 22.1071C12.0639 22.1135 11.9976 22.1027 11.9372 22.0759C11.8768 22.0491 11.8243 22.007 11.785 21.9539C11.6926 21.8553 11.6413 21.7252 11.6413 21.5901C11.6413 21.455 11.6926 21.3249 11.785 21.2263L13.4318 19.5795C13.3881 19.4694 13.3623 19.3531 13.3552 19.2349C13.3377 19.0523 13.3582 18.868 13.4154 18.6937C13.4727 18.5195 13.5654 18.3589 13.6877 18.2222C13.81 18.0855 13.9593 17.9756 14.1261 17.8994C14.293 17.8232 14.4738 17.7824 14.6573 17.7796C14.776 17.7825 14.8931 17.8085 15.0019 17.8562C15.0785 17.8562 15.0785 17.9328 15.0402 17.9711L14.2743 18.6987C14.2566 18.7076 14.2417 18.7213 14.2313 18.7382C14.2209 18.7551 14.2153 18.7746 14.2153 18.7944C14.2153 18.8143 14.2209 18.8338 14.2313 18.8507C14.2417 18.8676 14.2566 18.8812 14.2743 18.8902L14.7721 19.388C14.7858 19.4055 14.8032 19.4197 14.8231 19.4294C14.843 19.4392 14.8649 19.4442 14.887 19.4442C14.9092 19.4442 14.9311 19.4392 14.951 19.4294C14.9709 19.4197 14.9883 19.4055 15.0019 19.388L15.7296 18.6604C15.7679 18.6221 15.8828 18.6221 15.8828 18.6987C15.9225 18.81 15.9482 18.9257 15.9593 19.0434C15.9565 19.2318 15.9147 19.4176 15.8365 19.5891C15.7584 19.7606 15.6457 19.9141 15.5055 20.04C15.3652 20.1658 15.2005 20.2613 15.0215 20.3205C14.8426 20.3797 14.6534 20.4012 14.4658 20.3838Z" fill="#686868" />
                                                                                                                   <path d="M7.32654 15.8357C10.0426 15.8357 12.2444 13.6339 12.2444 10.9179C12.2444 8.2018 10.0426 6 7.32654 6C4.61049 6 2.40869 8.2018 2.40869 10.9179C2.40869 13.6339 4.61049 15.8357 7.32654 15.8357Z" fill="#686868" />
                                                                                                                   <path d="M8.72579 24.2284C9.56775 24.2284 9.1085 23.6602 9.1085 23.6602C8.26352 22.6183 7.80432 21.3214 7.80729 19.9853C7.80323 19.1479 7.98619 18.32 8.34308 17.5607C8.35915 17.5174 8.38538 17.4784 8.41962 17.4471C8.68752 16.9167 8.15173 16.8788 8.15173 16.8788C7.91072 16.8473 7.66759 16.8346 7.42458 16.8409C5.62273 16.8479 3.88304 17.4937 2.52093 18.6614C1.15881 19.829 0.264455 21.4412 0 23.2055C0 23.5844 0.114813 24.2663 1.30121 24.2663H8.61098C8.68752 24.2284 8.68752 24.2284 8.72579 24.2284Z" mfill="#686868" />
                                                                                                                     </g>
                                                                                                                      <defs>
                                                                                                                      <clipPath id="clip0_2128_398">
                                                                                                                      <rect width="30" height="30" fill="white" />
                                                                                                                      </clipPath>
                                                                                                                       </defs>
                                                                                                                     </svg>',
                'subitems' => array_filter([
                    \Auth::user()->can('view permission')
                        ? ['label' => 'Permission', 'route' => route('permission.index')]
                        : null,
                    \Auth::user()->can('create role')
                        ? ['label' => 'Role', 'route' => route('permission.role')]
                        : null,
                ]),
            ])
        @endif

        @if (\Auth::user()->can('manage settings'))
            @include('components.sidebar.sidebar-item', [
                'isActive' => request()->routeIs('settings.*'),
                'route' => route('settings.site'),
                'icon' => '<i class="fa-solid fa-gear"></i>',
                'label' => 'Settings',
            ])
        @endif


        @if (\Auth::user()->can('view accounting setting'))
            @include('components.sidebar.sidebar-dropdown', [
                'title' => 'Accounting Setting',
                'icon' => '<i class="fas fa-university"></i>',
                'subitems' => array_filter([
                    \Auth::user()->can('view accounting setting')
                        ? ['label' => 'Bank Accounts', 'route' => route('metro.berry.account.setting')]
                        : null,
                ]),
            ])
        @endif

    </ul>
</nav>
