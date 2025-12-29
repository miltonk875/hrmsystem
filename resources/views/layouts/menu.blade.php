<li>
    <a id="dashboard" class="app-menu__item" href="{{ URL::to('dashboard') }}">
        <i class="app-menu__icon bi bi-speedometer" style="color: #ffa86a;"></i>
        <span class="app-menu__label">Dashboard</span>
    </a>
</li>
<li>
    <a id="employees" class="app-menu__item" href="{{URL::to('employees')}}">
        <i class="app-menu__icon fa fa-users" style="color: #f27e2b;"></i>
        <span class="app-menu__label">Employee</span>
    </a>
</li>
<li>
    <a id="departments" class="app-menu__item" href="{{URL::to('departments')}}">
        <i class="app-menu__icon fa fa-cubes" style="color: #f27e2b;"></i>
        <span class="app-menu__label">Department</span>
    </a>
</li>
<li>
    <a id="skills" class="app-menu__item" href="{{URL::to('skills')}}">
        <i class="app-menu__icon fa fa-lightbulb" style="color: #f27e2b;"></i>
        <span class="app-menu__label">Skill</span>
    </a>
</li>
<li>
    <a id="user_management" class="app-menu__item" href="{{URL::to('user_management')}}">
        <i class="app-menu__icon fa fa-user-secret" style="color: #f27e2b;"></i>
        <span class="app-menu__label">System Users</span>
    </a>
</li>
<li>
    <a id="dashboard" class="app-menu__item" href="{{ URL::to('clearcache') }}">
        <i class="app-menu__icon bi bi-circle" style="color: #f27e2b;"></i>
        <span class="app-menu__label">Clear System Cache</span>
    </a>
</li>
<li>
    <a class="app-menu__item logout" style="cursor: pointer">
        <i class="app-menu__icon fa fa-sign-out" style="color: #f27e2b;"></i>
        <span class="app-menu__label">Logout</span>
    </a>
</li>