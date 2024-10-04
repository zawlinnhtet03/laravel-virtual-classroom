<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>

                <!-- <li class="{{ set_active(['setting/page']) }}">
                    <a href="{{ route('setting/page') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                        <span class="menu-arrow"></span>
                    </a>
                </li> -->
                {{-- ADMIN --}}
                @if (Session::get('role_name') === 'Admin')
                    <li class="{{ set_active(['home']) }}">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span> Admin Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                    </li>
                    <li
                        class="submenu {{ set_active(['posts.index', 'posts.create']) }} {{ request()->is('posts*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-bell"></i>
                            <span>Notifications</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('posts') ? 'active' : '' }}"
                                    href="{{ route('posts.index') }}">
                                    Notification List
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('posts/create') ? 'active' : '' }}"
                                    href="{{ route('posts.create') }}">
                                    Create Notifications
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-shield-alt"></i>
                            <span>User Management</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('list/users') }}"
                                    class="{{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">List
                                    User</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="submenu {{ set_active(['teacher/add/page', 'teacher/list/page', 'teacher/grid/page', 'teacher/edit']) }} {{ request()->is('teacher/edit/*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span> Teachers</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('teacher/list/page') }}"
                                    class="{{ set_active(['teacher/list/page', 'teacher/grid/page']) }}">Teacher
                                    List</a>
                            </li>
                            <li>
                                <a href="{{ route('teacher/add/page') }}"
                                    class="{{ set_active(['teacher/add/page']) }}">Add Teachers</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page']) }} {{ request()->is('student/edit/*') ? 'active' : '' }} {{ request()->is('student/profile/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i>
                            <span> Students</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul>
                            <li>
                                <a href="{{ route('student/list') }}"
                                    class="{{ set_active(['student/list', 'student/grid']) }}">Student List</a>
                            </li>

                            <li>
                                <a href="{{ route('student/add/page') }}"
                                    class="{{ set_active(['student/add/page']) }}">Add Students</a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="submenu {{ set_active(['subject/list/page', 'subject/add/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book-reader"></i>
                            <span> Subjects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li>
                                <a class="{{ set_active(['subject/list/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}"
                                    href="{{ route('subject/list/page') }}">Subject List</a>
                            </li>


                            <li>
                                <a class="{{ set_active(['subject/add/page']) }}"
                                    href="{{ route('subject/add/page') }}">Add Subjects</a>
                            </li>

                        </ul>
                    </li>
                @elseif (Session::get('role_name') === 'Teachers')
                    <li class="{{ set_active(['teacher/dashboard']) }}">
                        <a href="{{ route('teacher/dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span> Teacher Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                    </li>
                    @if (\App\Models\Teacher::where('user_id', auth()->user()->user_id)->exists())
                        <li
                            class="submenu {{ set_active(['posts.index', 'posts.create']) }} {{ request()->is('posts*') ? 'active' : '' }}">
                            <a href="#">
                                <i class="fas fa-bell"></i>
                                <span>Notifications</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('posts') ? 'active' : '' }}"
                                        href="{{ route('posts.index') }}">
                                        Notification List
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('posts/create') ? 'active' : '' }}"
                                        href="{{ route('posts.create') }}">
                                        Create Notifications
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="{{ set_active(['meetings']) }}">
                            <a href="{{ route('meeting.index') }}">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Live Classes</span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li> --}}


                        <li
                            class="submenu {{ set_active(['meeting.index', 'meeting.create']) }} {{ request()->is('meetings*') ? 'active' : '' }}">
                            <a href="#">
                                <i class="fas fa-bell"></i>
                                <span>Live Classes</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('meetings') ? 'active' : '' }}"
                                        href="{{ route('meeting.index') }}">
                                        Meeting List
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('meetings/create') ? 'active' : '' }}"
                                        href="{{ route('meeting.create') }}">
                                        Create Meeting
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['study_materials', 'study_materials/create', 'study_materials/edit/*']) }} {{ request()->is('study_materials/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-open"></i>
                                <span>Study Materials</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['study_materials']) }} {{ request()->is('study_materials') ? 'active' : '' }}"
                                        href="{{ route('study_materials.index') }}">Material List</a>
                                </li>


                                <li>
                                    <a class="{{ set_active(['study_materials/create']) }}"
                                        href="{{ route('study_materials.create') }}">Add Material</a>
                                </li>

                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['subject/list/page', 'subject/add/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['subject/list/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}"
                                        href="{{ route('subject/list/page') }}">Subject List</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page']) }} {{ request()->is('student/edit/*') ? 'active' : '' }} {{ request()->is('student/profile/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-graduation-cap"></i>
                                <span> Students</span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul>
                                <li>
                                    <a href="{{ route('student/list') }}"
                                        class="{{ set_active(['student/list', 'student/grid']) }}">Student List</a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="submenu {{ set_active(['assignments', 'assignments/create', 'assignments/edit/*']) }} {{ request()->is('assignments/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book"></i>
                                <span>Assignments</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['assignments']) }} {{ request()->is('assignments') ? 'active' : '' }}"
                                        href="{{ route('assignments.index') }}">Assignment List</a>
                                </li>
                                <li>
                                    <a class="{{ set_active(['assignments/create']) }}"
                                        href="{{ route('assignments.create') }}">Add Assignments</a>
                                </li>
                                <li>
                                    <a class="{{ set_active(['assignments/submissions']) }}"
                                        href="{{ route('assignments.submissions') }}">Assignment Submissions</a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="submenu {{ set_active(['quizzes', 'quizzes/create', 'quizzes/edit/*', 'quiz_submissions/*']) }} {{ request()->is('quizzes/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-clipboard"></i>
                                <span>Quizzes</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['quizzes']) }} {{ request()->is('quizzes') ? 'active' : '' }}"
                                        href="{{ route('quizzes.index') }}">Quiz List</a>
                                </li>
                                <li>
                                    <a class="{{ set_active(['quizzes/create']) }}"
                                        href="{{ route('quizzes.create') }}">Add Quizzes</a>
                                </li>
                                <li>
                                    <a class="{{ set_active(['quiz_submissions']) }}"
                                        href="{{ route('quiz_submissions.index') }}">Quiz Submissions</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('no-access') }}"><i class="fas fa-exclamation-triangle"></i>
                                <span>No Access</span></span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li>
                    @endif
                @elseif(Session::get('role_name') === 'Student')
                    <li class="{{ set_active(['student/dashboard']) }}">
                        <a href="{{ route('student/dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span> Student Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                    </li>
                    @if (\App\Models\Student::where('user_id', auth()->user()->user_id)->exists())
                        <li
                            class="submenu {{ set_active(['posts.index', 'posts.create']) }} {{ request()->is('posts*') ? 'active' : '' }}">
                            <a href="#">
                                <i class="fas fa-bell"></i>
                                <span>Notifications</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('posts') ? 'active' : '' }}"
                                        href="{{ route('posts.index') }}">
                                        Notification List
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['meeting.index', 'meeting.create']) }} {{ request()->is('meetings*') ? 'active' : '' }}">
                            <a href="#">
                                <i class="fas fa-bell"></i>
                                <span>Live Classes</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('meetings') ? 'active' : '' }}"
                                        href="{{ route('meeting.index') }}">
                                        Meeting List
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li
                            class="submenu {{ set_active(['study_materials', 'study_materials/create', 'study_materials/edit/*']) }} {{ request()->is('study_materials/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-open"></i>
                                <span>Study Materials</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['study_materials']) }} {{ request()->is('study_materials') ? 'active' : '' }}"
                                        href="{{ route('study_materials.index') }}">Material List</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['subject/list/page', 'subject/add/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['subject/list/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}"
                                        href="{{ route('subject/list/page') }}">Subject List</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['assignments', 'assignments/create', 'assignments/edit/*']) }} {{ request()->is('assignments/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book"></i>
                                <span>Assignments</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['assignments']) }} {{ request()->is('assignments') ? 'active' : '' }}"
                                        href="{{ route('assignments.index') }}">Assignment List</a>
                                </li>
                                <li>
                                    <a class="{{ set_active(['assignments/submissions']) }}"
                                        href="{{ route('assignments.submissions') }}">Assignment Submissions</a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="submenu {{ set_active(['quizzes', 'quizzes/create', 'quizzes/edit/*', 'quiz_submissions/*']) }} {{ request()->is('quizzes/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-clipboard"></i>
                                <span>Quizzes</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a class="{{ set_active(['quizzes']) }} {{ request()->is('quizzes') ? 'active' : '' }}"
                                        href="{{ route('quizzes.index') }}">Quiz List</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('no-access') }}"><i class="fas fa-exclamation-triangle"></i>
                                <span>No Access</span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
