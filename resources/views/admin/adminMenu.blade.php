<!-- <div class="container" style="background-color: white; width: 100%"> -->
	<div class="nav-tabs-custom menu">
		<div class="col-md-10">
			<ul class="nav navbar-nav">
		  <li class="active">
		  	<a href="/admin">ĐỒ ÁN</a>
		  </li>
		  <li class="active">
		  	<a href="/admin/student">SINH VIÊN</a>
		  </li>
		  <li class="active">
		  	<a href="/admin/teacher">GIẢNG VIÊN</a>
		  </li>
		</ul>
		</div>

		<div class="col-md-2">
			<ul class="nav navbar-nav">
            <!-- Authentication Links -->


            
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('admin')->user()->username }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
        </ul>
		</div>
	</div>
<!-- </div> -->