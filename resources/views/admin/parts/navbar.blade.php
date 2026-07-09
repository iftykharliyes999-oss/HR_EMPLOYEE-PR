 <div class="primary-menu">
     <nav class="navbar navbar-expand-lg align-items-center">
         <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
             <div class="offcanvas-header border-bottom">
                 <div class="d-flex align-items-center">
                     <div class="">
                         <img src="{{ asset('') }}assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                     </div>
                     <div class="">
                         <h4 class="logo-text">Dashtreme</h4>
                     </div>
                 </div>
                 <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
             </div>
             <div class="offcanvas-body">
                 <ul class="navbar-nav align-items-center flex-grow-1">
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-home-alt'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Dashboard</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                         class='bx bx-pie-chart-alt'></i>Default</a></li>
                             <li>
                                 <a class="dropdown-item" href="{{ route('admin.managers.index') }}">
                                     <i class='bx bx-user-plus'></i>
                                     All Manager
                                 </a>
                             </li>
                             <li>
    <a class="dropdown-item" href="{{ route('admin.employees.index') }}">
        <i class='bx bx-user'></i>
        All Employee
    </a>
</li>
                             <li><a class="dropdown-item" href="{{ asset('') }}dashboard-analytics.html"><i
                                         class='bx bx-line-chart-down'></i>Analytics</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}dashboard-alternate.html"><i
                                         class='bx bx-shield-alt-2'></i>Alternate</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}dashboard-digital-marketing.html"><i
                                         class='bx bx-bar-chart-alt-2'></i>Digital Marketing</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}dashboard-human-resources.html"><i
                                         class='bx bx-cylinder'></i>Human Resources</a></li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-cube'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Apps & Pages</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="{{ asset('') }}app-emailbox.html"><i
                                         class='bx bx-envelope'></i>Email</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}app-chat-box.html"><i
                                         class='bx bx-conversation'></i>Chat Box</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}app-file-manager.html"><i
                                         class='bx bx-file'></i>File Manager</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}app-contact-list.html"><i
                                         class='bx bx-microphone'></i>Contacts</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}app-to-do.html"><i
                                         class='bx bx-check-shield'></i>Todo</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}app-invoice.html"><i
                                         class='bx bx-printer'></i>Invoice</a></li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-file'></i>Pages</a>
                                 <ul class="dropdown-menu submenu">
                                     <li class="nav-item dropend"><a
                                             class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                             href="{{ asset('') }}javascript:;"><i
                                                 class='bx bx-radio-circle'></i>Error</a>
                                         <ul class="dropdown-menu">
                                             <li><a class="dropdown-item"
                                                     href="{{ asset('') }}errors-404-error.html"><i
                                                         class='bx bx-radio-circle'></i>404 Error</a></li>
                                             <li><a class="dropdown-item"
                                                     href="{{ asset('') }}errors-500-error.html"><i
                                                         class='bx bx-radio-circle'></i>500 rror</a></li>
                                             <li><a class="dropdown-item"
                                                     href="{{ asset('') }}errors-coming-soon.html"><i
                                                         class='bx bx-radio-circle'></i>Coming Soon</a></li>
                                             <li><a class="dropdown-item"
                                                     href="{{ asset('') }}error-blank-page.html"><i
                                                         class='bx bx-radio-circle'></i>Blank Page</a></li>
                                         </ul>
                                     </li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}user-profile.html"><i
                                                 class='bx bx-radio-circle'></i>User Profile</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}timeline.html"><i
                                                 class='bx bx-radio-circle'></i>Timeline</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}faq.html"><i
                                                 class='bx bx-radio-circle'></i>FAQ</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}pricing-table.html"><i
                                                 class='bx bx-radio-circle'></i>Pricing</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Forms</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-elements.html"><i
                                         class='bx bx-message-square-dots'></i>Form Elements</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-input-group.html"><i
                                         class='bx bx-book-content'></i>Input Groups</a>
                             </li>
                             <li> <a class="dropdown-item"
                                     href="{{ asset('') }}form-radios-and-checkboxes.html"><i
                                         class='bx bx-radio-circle-marked'></i>Radios & Checkboxes</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-layouts.html"><i
                                         class='bx bx-layer'></i>Forms Layouts</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-validations.html"><i
                                         class='bx bx-file-blank'></i>Form Validation</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-wizard.html"><i
                                         class='bx bx-glasses'></i>Form Wizard</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-text-editor.html"><i
                                         class='bx bx-edit'></i>Text Editor</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-file-upload.html"><i
                                         class='bx bx-upload'></i>File Upload</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-date-time-pickes.html"><i
                                         class='bx bx-calendar-check'></i>Date Pickers</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-select2.html"><i
                                         class='bx bx-check-double'></i>Select2</a>
                             </li>
                             <li> <a class="dropdown-item" href="{{ asset('') }}form-repeater.html"><i
                                         class='bx bx-directions'></i>Form Repeater</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-lock'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Authentication</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-receipt'></i>Basic</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item" href="{{ asset('') }}auth-basic-signin.html"><i
                                                 class='bx bx-radio-circle'></i>Sign In</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}auth-basic-signup.html"><i
                                                 class='bx bx-radio-circle'></i>Sign Up</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-basic-forgot-password.html"><i
                                                 class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-basic-reset-password.html"><i
                                                 class='bx bx-radio-circle'></i>Reset Password</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-cylinder'></i>Cover</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item" href="{{ asset('') }}auth-cover-signin.html"><i
                                                 class='bx bx-radio-circle'></i>Sign In</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}auth-cover-signup.html"><i
                                                 class='bx bx-radio-circle'></i>Sign Up</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-cover-forgot-password.html"><i
                                                 class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-cover-reset-password.html"><i
                                                 class='bx bx-radio-circle'></i>Reset Password</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-aperture'></i>Header &
                                     Footer</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-header-footer-signin.html"><i
                                                 class='bx bx-radio-circle'></i>Sign In</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-header-footer-signup.html"><i
                                                 class='bx bx-radio-circle'></i>Sign Up</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-header-footer-forgot-password.html"><i
                                                 class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}auth-header-footer-reset-password.html"><i
                                                 class='bx bx-radio-circle'></i>Reset Password</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-briefcase-alt'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">UI Elements</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li> <a class="dropdown-item" href="{{ asset('') }}widgets.html"><i
                                         class='bx bx-wine'></i>Widgets</a></li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-cart'></i>eCommerce</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}ecommerce-products.html"><i
                                                 class='bx bx-radio-circle'></i>Products</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}ecommerce-products-details.html"><i
                                                 class='bx bx-radio-circle'></i>Product Details</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}ecommerce-add-new-products.html"><i
                                                 class='bx bx-radio-circle'></i>Add New Products</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}ecommerce-orders.html"><i
                                                 class='bx bx-radio-circle'></i>Orders</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-ghost'></i>Components</a>
                                 <ul class="dropdown-menu scroll-menu">
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-alerts.html"><i
                                                 class='bx bx-radio-circle'></i>Alerts</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-accordions.html"><i
                                                 class='bx bx-radio-circle'></i>Accordions</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-badges.html"><i
                                                 class='bx bx-radio-circle'></i>Badges</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-buttons.html"><i
                                                 class='bx bx-radio-circle'></i>Buttons</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-cards.html"><i
                                                 class='bx bx-radio-circle'></i>Cards</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-carousels.html"><i
                                                 class='bx bx-radio-circle'></i>Carousels</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-list-groups.html"><i
                                                 class='bx bx-radio-circle'></i>List Groups</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-media-object.html"><i
                                                 class='bx bx-radio-circle'></i>Media Objects</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-modals.html"><i
                                                 class='bx bx-radio-circle'></i>Modals</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-navs-tabs.html"><i
                                                 class='bx bx-radio-circle'></i>Navs & Tabs</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}component-navbar.html"><i
                                                 class='bx bx-radio-circle'></i>Navbar</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-paginations.html"><i
                                                 class='bx bx-radio-circle'></i>Pagination</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-popovers-tooltips.html"><i
                                                 class='bx bx-radio-circle'></i>Popovers & Tooltips</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-progress-bars.html"><i
                                                 class='bx bx-radio-circle'></i>Progress</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-spinners.html"><i
                                                 class='bx bx-radio-circle'></i>Spinners</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-notifications.html"><i
                                                 class='bx bx-radio-circle'></i>Notifications</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}component-avtars-chips.html"><i
                                                 class='bx bx-radio-circle'></i>Avatrs & Chips</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-card'></i>Content</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}content-grid-system.html"><i
                                                 class='bx bx-radio-circle'></i>Grid System</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}content-typography.html"><i
                                                 class='bx bx-radio-circle'></i>Typography</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}content-text-utilities.html"><i
                                                 class='bx bx-radio-circle'></i>Text Utilities</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-droplet'></i>Icons</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item" href="{{ asset('') }}icons-line-icons.html"><i
                                                 class='bx bx-radio-circle'></i>Line Icons</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}icons-boxicons.html"><i
                                                 class='bx bx-radio-circle'></i>Boxicons</a></li>
                                     <li><a class="dropdown-item"
                                             href="{{ asset('') }}icons-feather-icons.html"><i
                                                 class='bx bx-radio-circle'></i>Feather Icons</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class='bx bx-line-chart'></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Charts</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="{{ asset('') }}charts-apex-chart.html"><i
                                         class='bx bx-bar-chart-alt-2'></i>Apex</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}charts-chartjs.html"><i
                                         class='bx bx-line-chart'></i>Chartjs</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}charts-highcharts.html"><i
                                         class='bx bx-pie-chart-alt'></i>HighCharts</a></li>
                             <li class="nav-item dropend">
                                 <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                     href="{{ asset('') }}javascript:;"><i class='bx bx-map-pin'></i>Maps</a>
                                 <ul class="dropdown-menu submenu">
                                     <li><a class="dropdown-item" href="{{ asset('') }}map-google-maps.html"><i
                                                 class='bx bx-radio-circle'></i>Google Maps</a></li>
                                     <li><a class="dropdown-item" href="{{ asset('') }}map-vector-maps.html"><i
                                                 class='bx bx-radio-circle'></i>Vector Maps</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                             href="{{ asset('') }}javascript:;" data-bs-toggle="dropdown">
                             <div class="parent-icon"><i class="bx bx-grid-alt"></i>
                             </div>
                             <div class="menu-title d-flex align-items-center">Tables</div>
                             <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                         </a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="{{ asset('') }}table-basic-table.html"><i
                                         class='bx bx-table'></i>Basic Table</a></li>
                             <li><a class="dropdown-item" href="{{ asset('') }}table-datatable.html"><i
                                         class='bx bx-data'></i>Data Table</a></li>
                         </ul>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
 </div>
