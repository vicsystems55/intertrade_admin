<div class="p-3">

</div>

<ul class="metismenu" id="menu">

    <li>
        <a href="{{route('technician')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

{{--
    <li>
        <a href="#">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Reports</div>
        </a>
    </li>


    <li>
        <a href="/">
            <div class="parent-icon"><i class='bx bx-pen'></i>
            </div>
            <div class="menu-title">Create Report</div>
        </a>
    </li> --}}




    <li>
        <a href="{{route('technician.profile')}}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Profile</div>
        </a>
    </li>

    <li>
        <a href="{{route('technician.cash_request')}}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Cash Request</div>
        </a>
    </li>

    <li>
        <a href="{{route('technician.notifications')}}">
            <div class="parent-icon"><i class='bx bx-bell'></i>
            </div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>








</ul>
