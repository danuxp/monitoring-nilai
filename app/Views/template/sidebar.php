<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard-admin'); ?>">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('kelas'); ?>">Kelas</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('mapel'); ?>">Mapel</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('tahunajaran'); ?>">Tahun Ajaran</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('siswa'); ?>">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Data Siswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('guru'); ?>">
                <i class="typcn typcn-group menu-icon"></i>
                <span class="menu-title">Data Guru</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('jadwal'); ?>">
                <i class="typcn typcn-calendar-outline menu-icon"></i>
                <span class="menu-title">Jadwal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('nilai'); ?>">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Nilai</span>
            </a>
        </li>

    </ul>
</nav>