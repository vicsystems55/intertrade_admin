<ul class="metismenu mt-2" id="menu">
    <!-- <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>

    </li> -->
    <!-- <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Application</div>
        </a>
        <ul>
            <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
            </li>
            <li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
            </li>
            <li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
            </li>
            <li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
            </li>
            <li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
            </li>
            <li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
            </li>
            <li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
            </li>
        </ul>
    </li>
    <li class="menu-label">UI Elements</li> -->
    <li>
        <a href="/superadmin">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li class="menu-label">Records</li>


    <li>
        <a href="{{route('superadmin.staff_records')}}">
            <div class="parent-icon"><i class='lni lni-users'></i>
            </div>
            <div class="menu-title">Staff Records</div>
        </a>
    </li>

    <li>
        <a href="{{route('superadmin.customer')}}">
            <div class="parent-icon"><i class='lni lni-users'></i>
            </div>
            <div class="menu-title">Customer Records</div>
        </a>
    </li>

    {{-- <li>
        <a href="#">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Reports</div>
        </a>
    </li> --}}

    <li>
        <a href="{{route('clientProjects.index')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Projects</div>
        </a>
    </li>

    {{-- <li>
        <a href="{{route('superadmin.deployments')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Deployments</div>
        </a>
    </li> --}}

    {{-- <li>
        <a href="{{route('superadmin.truck_routes')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Truck Routes</div>
        </a>
    </li> --}}

    {{-- <li>
        <a href="{{route('superadmin.installation_schedule')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Installation Schedule</div>
        </a>
    </li> --}}

    <li class="menu-label">Operations</li>

     <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Products <span class="badge bg-danger ">new</span></div>
        </a>
        <ul>
            <li> <a href="/admin/products"><i class="bx bx-right-arrow-alt"></i>Product Catalog  </a>
            </li>
            <li> <a href="/admin/product-categories"><i class="bx bx-right-arrow-alt"></i>Product Categories  </a>
            </li>

        </ul>
    </li>

    <li>
        <a href="{{route('stockManagement.index')}}">
            <div class="parent-icon"><i class='bx bx-buildings'></i>
            </div>
            <div class="menu-title">Stock Management</div>
        </a>
    </li>
    <li>
        <a href="{{route('superadmin.pos')}}">
            <div class="parent-icon"><i class='bx bx-cog'></i>
            </div>
            <div class="menu-title">Sales Point</div>
           </a>
    </li>
    <li class="menu-label">Accounts</li>

    <li>
        <a href="{{route('cash_request')}}">
            <div class="parent-icon"><i class='bx bx-money'></i>
            </div>
            <div class="menu-title">Cash Request</div>
           </a>
    </li>

    <li class="menu-label">Data Center</li>

    <li>
        <a href="/admin/file-manager">
            <div class="parent-icon"><i class='bx bx-folder-open'></i>
            </div>
            <div class="menu-title">File Manager</div>
           </a>
    </li>


    <li class="menu-label">Activity Feed</li>


    <li>
        <a href="{{route('superadmin.notifications')}}">
            <div class="parent-icon"><i class='bx bx-bell'></i>
            </div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>

    <li>
        <a href="{{route('superadmin.messages')}}">
            <div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
            </div>
            <div class="menu-title">Messages</div>
        </a>
    </li>


    <li class="menu-label">Control</li>



    <li>
        <a href="{{route('admin.settings')}}">
            <div class="parent-icon"><i class='bx bx-cog'></i>
            </div>
            <div class="menu-title">Settings</div>
        </a>
    </li>






</ul>
