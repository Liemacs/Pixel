<ul>
    <li class="{{ \Request::is('user/dashbaord')? 'active' : '' }}">
        <a href="{{ route('user.dashbaord') }}">Dashbaord</a>
    </li>
    <li class="{{ \Request::is('user/order')? 'active' : '' }}">
        <a href="{{ route('user.order') }}">Orders</a>
    </li>
    <li class="{{ \Request::is('user/account')? 'active' : '' }}">
        <a href="{{ route('user.account') }}">Account details</a>
    </li>
    <li class="{{ \Request::is('user/logout')? 'active' : '' }}">
        <a href="{{ route('user.logout') }}">Logout</a>
    </li>
</ul>