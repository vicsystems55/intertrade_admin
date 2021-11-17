    <div class="p-3">
        <h6 class="font-weight-bold">
            Driver Dashboard
        </h6>
    </div>

<ul class="metismenu" id="menu">

    <li>
        <a href="{{route('driver')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.projects')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Projects</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.deployments')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Deployments</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.truck_routes')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Truck Routes</div>
        </a>
    </li>


    <li>
        <a href="{{route('driver.reports')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Reports</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.create_report')}}">
            <div class="parent-icon"><i class='bx bx-pen'></i>
            </div>
            <div class="menu-title">Create Report</div>
        </a>
    </li>


    <li>
        <a href="{{route('driver.profile')}}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Profile</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.notifications')}}">
            <div class="parent-icon"><i class='bx bx-bell'></i>
            </div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>

    <li>
        <a href="{{route('driver.messages')}}">
            <div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
            </div>
            <div class="menu-title">Messages</div>
        </a>
    </li>

   

   
    
    
</ul>

@include('general.requisition_form')