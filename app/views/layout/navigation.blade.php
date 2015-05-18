
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">

                            {{ HTML::image('img/user-none.jpg', 'User Image', array('class' => 'img-circle')) }}
                        </div>
                        <div class="pull-left info">
                            <p>Xin Chào,  {{Confide::user() ? Confide::user()->username : ""   }}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li class="active">
                            {{--<a href="{{URL::to('unions')}}">--}}
                            <a href="{{URL::route('root')}}">
                                <i class="fa fa-dashboard"></i> <span>Tổng Hợp</span>
                            </a>
                        </li>
                        @if( (Confide::user()->hasRole('Admin') ||Confide::user()->hasRole('Secretary') ))

                         @if(Confide::user()->can('use_menu_ql_doan_vien'))
                             <li >
                            {{--<a href="{{URL::to('unions')}}">--}}
                            <a href="{{URL::route('members.index')}}">
                                <i class="fa  fa-user"></i> <span>Quản Lý Đoàn Viên</span>
                            </a>
                        </li>
                        @endif
                         <li class="treeview" >
                        {{--<a href="{{URL::to('unions')}}">--}}
                        <a href="">
                            <i class="fa  fa-users"></i> <span>Quản Lý Chi Đoàn</span>
                         <i class="fa fa-angle-left pull-right"></i>
                        </a>
                           <ul class="treeview-menu">
                            @if(Confide::user()->can('use_menu_danh_sach_chi_doan'))
                           <li><a href="{{URL::route('union.admin')}}"><i class="fa fa-angle-double-right"></i> Danh Sách Chi Đoàn</a></li>
                         @endif
                            @if(Confide::user()->can('use_menu_danh_sach_can_bo'))
                          <li><a href="{{URL::route('teacher.index')}}"><i class="fa fa-angle-double-right"></i> Danh Sách Cán Bộ</a></li>
                           @endif
                         @if(Confide::user()->can('use_menu_ban_chap_hanh'))
                         <li><a href="{{URL::route('competence.index')}}"><i class="fa fa-angle-double-right"></i> Ban Chấp Hành</a></li>
                          @endif
                          @if(Confide::user()->can('use_menu_ll_nong_cot'))
                           <li><a href="{{URL::route('core.index')}}"><i class="fa fa-angle-double-right"></i> Lực Lượng Nòng Cốt</a></li>
                          @endif
                         @if(Confide::user()->can('use_menu_de_cu_ll_nong_cot'))
                            <li><a href="{{URL::route('appoint.member')}}"><i class="fa fa-angle-double-right"></i> Lực Lượng Nòng Cốt</a></li>
                             @endif
                          {{--<li><a href="{{URL::route('admin.activity.index')}}"><i class="fa fa-angle-double-right"></i> Chấm Điểm Rèn Luyện</a></li>--}}



                       </ul>
                    </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-trophy"></i> <span>Quản Lý Khen Thưởng</span>
                                 <i class="fa fa-angle-left pull-right"></i>
                            </a>
                       <ul class="treeview-menu">

                           @if(Confide::user()->can('use_menu_dot_khen_thuong'))
                           <li><a href="{{URL::route('index.admin.period')}}"><i class="fa fa-angle-double-right"></i> Đợt Khen Thưởng</a></li>
                           @endif
                            @if(Confide::user()->can('use_menu_ds_chinh_thuc'))
                           <li><a href="{{URL::route('honor.admin')}}"><i class="fa fa-angle-double-right"></i> Danh Sách Chính Thức</a></li>
                           @endif
                            @if(Confide::user()->can('use_menu_de_cu_ds_khenthuong'))
                    <li><a href="{{URL::route('honor.index')}}"><i class="fa fa-angle-double-right"></i>Đề Cữ </a></li>
                            @endif

                       </ul>
                        </li>
                                                <li class="treeview">
                                                    <a href="#">
                                                        <i class="fa fa-trophy"></i> <span>Quản Lý Trực Nhật</span>
                                                         <i class="fa fa-angle-left pull-right"></i>
                                                    </a>
                                               <ul class="treeview-menu">

                                                   @if(Confide::user()->can('use_menu_truc_nhat'))
                                                   <li><a href="{{URL::route('shifts.index')}}"><i class="fa fa-angle-double-right"></i> Đăng ký trực</a></li>
                                                   @endif
                                                    @if(Confide::user()->can('use_menu_ql_truc_nhat'))
                                                   <li><a href="{{URL::route('shifts.index.admin')}}"><i class="fa fa-angle-double-right"></i> Quản Lý danh sách trực</a></li>
                                                   @endif


                                               </ul>
                                                </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-paper-plane"></i>
                                <span>Quản Lý Hoạt Động </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              @if(Confide::user()->can('use_menu_hd_doankhoa'))
                                <li><a href="{{URL::route('admin.school.activity')}}"><i class="fa fa-angle-double-right"></i> Hoạt Động Đoàn Khoa</a></li>
                               @endif
                                @if(Confide::user()->can('use_menu_hd_doan_cs'))
                                <li><a href="{{URL::route('admin.activity.index')}}"><i class="fa fa-angle-double-right"></i>Hoạt Động Đoàn cơ sỡ</a></li>
                                  @endif
                                  @if(Confide::user()->can('use_menu_ql_hd_doan_co_so'))

                                <li><a href="{{URL::route('activity.index')}}"><i class="fa fa-angle-double-right"></i>Hoạt Động Chi Đoàn</a></li>
                                  @endif
                            </ul>
                        </li>
                          <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-money"></i>
                                <span>Quản Lý Đoàn Phí </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                             @if(Confide::user()->can('use_menu_ql_muc_doan_phi'))
                                <li><a href="{{URL::route('admin.fee.index')}}"><i class="fa fa-angle-double-right"></i> Quản Lý Mức Đoàn Phí</a></li>
                             @endif
                              @if(Confide::user()->can('use_menu_ql_thu_doan_phi'))
                                <li><a href="{{URL::route('admin.fee.union')}}"><i class="fa fa-angle-double-right"></i> Quản Lý Thu Đoàn Phí</a></li>
                            @endif
                            @if(Confide::user()->can('use_menu_ql_thu_doan_phi_cs'))
                <li><a href="{{URL::route('fee.index')}}"><i class="fa fa-angle-double-right"></i>Quản lý Đoàn Phí Chi Đoàn</a></li>
                            @endif
                            </ul>
                        </li>
                        @if(Confide::user()->can('use_menu_phan_quyen'))
                          <li >
                            <a href="{{URL::route('role.index')}}">
                                <i class="fa  fa-key"></i>
                                <span>Phân Quyền </span>
                            </a>

                        </li>
                        @endif
                        @else
                                         <li class="treeview">
                                                    <a href="#">
                                                        <i class="fa fa-trophy"></i> <span>Quản Lý Trực Nhật</span>
                                                         <i class="fa fa-angle-left pull-right"></i>
                                                    </a>
                                               <ul class="treeview-menu">

                                                   @if(Confide::user()->can('use_menu_truc_nhat'))
                                                   <li><a href="{{URL::route('shifts.index')}}"><i class="fa fa-angle-double-right"></i> Đăng ký trực</a></li>
                                                   @endif
                                                    @if(Confide::user()->can('use_menu_ql_truc_nhat'))
                                                   <li><a href="{{URL::route('shifts.index.admin')}}"><i class="fa fa-angle-double-right"></i> Quản Lý danh sách trực</a></li>
                                                   @endif


                                               </ul>
                                                </li>
                        @endif
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
