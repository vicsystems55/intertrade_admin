<ul class="metismenu" id="menu">
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
        <a href="{{route('admin')}}">
            <div class="parent-icon"><i class='bx bx-desktop'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li class="menu-label">Operations</li>
    <li>
     <a href="{{route('admin.projects')}}">
         <div class="parent-icon"><i class='bx bx-cog'></i>
         </div>
         <div class="menu-title">Projects</div>
     </a>
 </li>
    <li class="menu-label">Management</li>
    <li>
        <a href="{{route('admin.staff_records')}}">
            <div class="parent-icon"><i class='lni lni-users'></i>
            </div>
            <div class="menu-title">Staff Records</div>
        </a>
    </li>

    <li>
        <a href="{{route('admin.reports')}}">
            <div class="parent-icon"><i class='bx bx-book'></i>
            </div>
            <div class="menu-title">Reports</div>
        </a>
    </li>

    <li>
        <a href="{{route('admin.inventories')}}">
            <div class="parent-icon"><i class='bx bx-buildings'></i>
            </div>
            <div class="menu-title">Inventory</div>
        </a>
    </li>
  

   

    <li class="menu-label">Correspondence</li>
    <li>
        <a href="{{route('admin.notifications')}}">
            <div class="parent-icon"><i class='bx bx-bell'></i>
            </div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>

    <li>
        <a href="{{route('admin.messages')}}">
            <div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
            </div>
            <div class="menu-title">Messages</div>
        </a>
    </li>
    <li class="menu-label">Settings</li>

    <li>
        <a href="{{route('admin.profile')}}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Profile</div>
        </a>
    </li>



    <li>
        <a href="#">
            <div class="parent-icon">
            </div>
            <div class="menu-title">

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Switch to Admin</label>
                </div>


            </div>
        </a>
    </li>

   
    
    
</ul>