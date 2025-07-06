<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  <div>
    <a href="index.html" class="sidebar-logo">
      <img src="{{asset('admin_assets/images/logo.png') }}" alt="site logo" class="light-logo">
      <img src="{{asset('admin_assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
      <img src="{{asset('admin_assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
    </a>
  </div>
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      <li>
        <a href="{{ route('admin.dashboard.index') }}">
          <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="chat-message.html">
          <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
          <span>Pengguna</span>
        </a>
      </li>
      <li>
        <a href="calendar-main.html">
          <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
          <span>Kelola Paket Trip</span>
        </a>
      </li>
      <li>
        <a href="kanban.html">
          <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
          <span>Jadwal Paket Trip</span>
        </a>
      </li>
      <li>
        <a href="kanban.html">
          <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
          <span>Booking & Tiket</span>
        </a>
      </li><li>
        <a href="kanban.html">
          <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
          <span>Penghasilan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.artikel.index') }}">
          <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
          <span>Artikel</span>
        </a>
      </li>
      <li>
        <a href="kanban.html">
          <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
          <span>Pengaturan</span>
        </a>
      </li>
  </div>
</aside>
