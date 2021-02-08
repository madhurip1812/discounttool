<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="#cashbackentity" data-toggle="collapse" class="main-menu @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) active @else collapsed @endif">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>Cashback</span>
                        <i class="fa @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) fa-chevron-down @else fa-chevron-right @endif pull-right" aria-hidden="true"></i>
                    </a>
                    <div id="cashbackentity" class="collapse @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) in @endif">
                        <ul class="nav">
                           
                            <li>
                                <a href="{{route('addcashback')}}" class="@if (Route::currentRouteName() == 'addcashback') active @endif">Add</a>
                            </li>
                            <li>
                                <a href="{{route('listcashback')}}" class="@if (Route::currentRouteName() == 'listcashback') active @endif">View</a>
                            </li>
                        </ul>
                    </div>
                </li>
              
            </ul>
        </nav>
    </div>
</div>