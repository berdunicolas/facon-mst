@props(['sectionId'])

<nav id="sidebar" class="bg-light sidebar d-flex flex-column text-dark">
    <div class="sidebar-toggler bg-light rounded-1" onclick="toggleSidebar(this)"><i class="bi bi-chevron-double-right"></i></div>
    <div class="sidebar-logo py-4 d-flex align-items-center">
        <img src="{{asset('images/facon-logo.svg')}}" class="logo" alt="facon logo">
        <img src="{{asset('images/facon-minimalist-logo.svg')}}" class="minimalist-logo" alt="facon minimalist logo">
    </div>
    <ul class="nav flex-column pt-5 font-size-2">
        <li class="nav-item mt-1 horizontal-red-gradient-bg {{$sectionId == 'home' ? 'selected' : ''}}">
            <a href="{{route('admin.dashboard')}}" class="nav-link text-dark btn btn-light rounded-0">
                <span class="nav-link-icon"><i class="bi bi-house"></i></span>
                <span class="nav-link-text">Inicio</span>
            </a>
        </li>
    </ul>
    <ul class="nav flex-column mt-auto mb-4 font-size-2">
        <li class="nav-item {{$sectionId == 'profile' ? 'selected' : ''}}">
            <a href="{{route('profile.show')}}" class="nav-link text-dark bg-cus-primary btn btn-light rounded-0">
                <span class="nav-link-icon"><i class="">NB</i></span>
                <span class="nav-link-text">{{auth()->user()->name}}</span>
            </a>
            <ul class="font-size-1">
                <ui class="nav-subordinate">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button  class="nav-link text-dark w-100 btn btn-light rounded-0">
                            <span class="nav-link-icon"><i class="bi bi-box-arrow-right"></i></span>
                            <span class="nav-link-text">Cerrar sesion</span>
                        </button>
                    </form>
                </ui>
            </ul>
        </li>
    </ul>

</nav>
<script>
    function toggleSidebar(toggle) {
        const sidebar = document.getElementById('sidebar');
        const logo = document.getElementById('logo');
        const minimalLogo = document.getElementById('minimal-logo');

        sidebar.classList.toggle('expanded');
        localStorage.setItem('sidebar-expanded', sidebar.classList.contains('expanded'));

        toggle = toggle.children[0];
        if(toggle.classList.contains('bi-chevron-double-right')){
            toggle.classList.replace('bi-chevron-double-right', 'bi-chevron-double-left');
        }else{
            toggle.classList.replace('bi-chevron-double-left', 'bi-chevron-double-right');
        }
    }

    const sidebar = document.getElementById('sidebar'); 

    // Restaurar estado
    if (localStorage.getItem('sidebar-expanded') === 'true') {
        sidebar.classList.add('expanded');
    }
</script>