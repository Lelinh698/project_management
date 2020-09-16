<!-- <div class="container"> -->
	<div class="nav-tabs-custom menu">
		<div class="col-md-10">
			<ul class="nav nav-tabs">
		  <li class="dropdown">
		  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">ĐỒ ÁN<span class="caret"></span></a>
		  	<ul class="dropdown-menu">
                  <li><a href="/teacher/ds">Danh sách đồ án</a></li>
            </ul>
		  </li>
		  <li class="dropdown">
		  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">KẾ HOẠCH<span class="caret"></span></a>
		  	<ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Danh sách kế hoạch</a></li>
            </ul>
		  </li>
		 <!--  <li class="dropdown">
		  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">TÀI LIỆU<span class="caret"></span></a>
		  	<ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="/filelist">Danh sách tài liệu</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="/file">Thêm tài liệu</a></li>
            </ul>
		  </li> -->
		  <li class="dropdown">
		  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">ĐÁNH GIÁ<span class="caret"></span></a>
		  	<ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Danh sách</a></li>
            </ul>
		  </li>
		</ul>
		</div>

		<div class="col-md-2">
			<ul class="nav navbar-nav">
            <!-- Authentication Links -->
            
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('teacher')->user()->username }} <span class="caret"></span>
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