<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
@php
use App\Models\Notification;
$notifications = Notification::where('user_id', auth()->user()->id)
                              ->whereDate('created_at', today())
                              ->get();
@endphp
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
      <span class="d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">{{ $notifications->count() }}</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          @forelse($notifications as $notification)
            <li class="notification-item">
              <i class="bi bi-info-circle"></i>
              <div>
                <h4>{{ $notification->type }}</h4>
                <p>{{ $notification->data }}</p>
                <p>{{ $notification->created_at->diffForHumans() }}</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
          @empty
            <li class="notification-item">
              <div>
                <p>No notifications</p>
              </div>
            </li>
          @endforelse
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>
        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
        </a><!-- End Profile Image Icon -->

     
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
