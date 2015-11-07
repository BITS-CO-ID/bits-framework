<?php
use BITS\BITS;
use BITS\Relationship;
use BITS\Query;

foreach (BITS::find('view_users_level', 'id', $_SESSION['id']) as $users) { ?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                    <?php if ($users['photo']) { ?>
                        <img alt="image" class="img-circle" width="44" height="44" src="<?php echo $users['photo']; ?>">
                    <?php } else { ?>
                        <img alt="image" class="img-circle" width="44" height="44" src="/public/files/img/2015-07-27-44240-true-love-never-ends.jpg">
                    <?php } ?>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $users['nama']; ?></strong>
                         </span> <span class="text-muted text-xs block"><?php echo $users['level']; ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <?php if ($users['id_level'] == 1) { ?>
                        <li><a href="/users/">Users Management</a></li>
                    <?php } ?>
                        <li><a href="/users/profile/">My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout/">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <i class="fa fa-diamond"></i>
                </div>
            </li>
            <li>
                <a href="/dashboard/"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php
            if ($_SESSION['level'] == 1 || $_SESSION['level'] == 5) { ?>
            <li>
                <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">Project Management</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="/project/"><i class="fa fa-building"></i> Data Project</a></li>
                    <?php
                    if (isset($_SESSION['id_project'])) { ?>
                    <li><a href="/project/kavling/"><i class="fa fa-print"></i> Laporan Utama</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <?php
            if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
                if (isset($_SESSION['id_project'])) { ?>
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Purchasing</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php
                    if ($_SESSION['level'] == 1) { ?>
                    <li><a href="/supplier/"><i class="fa fa-users"></i> Data Supplier</a></li>
                    <?php } ?>
                    <li><a href="/barang/"><i class="fa fa-server"></i> Data Barang</a></li>
                    <li><a href="/pembelian/"><i class="fa fa-shopping-cart"></i> Pembelian Barang</a></li>
                    <li>
                        <a href="#"><i class="fa fa-print"></i> Laporan<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a href="/pembelian/priode/"><i class="fa fa-calendar"></i> Priode</a></li>
                            <!--li><a href="/pembelian/supplier/"><i class="fa fa-users"></i> Supplier</a></li-->
                            <li><a href="/pembelian/transaksi/"><i class="fa fa-database"></i> Transaksi</a></li>
                            <!--li><a href="/pembelian/tipe/"><i class="fa fa-tag"></i> Jenis Transaksi</a></li-->
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-money"></i> Data Hutang<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a href="/hutang/priode/"><i class="fa fa-calendar"></i> Priode</a></li>
                            <li><a href="/hutang/transaksi/"><i class="fa fa-database"></i> Transaksi</a></li>
                        </ul>
                    </li>
                    <li><a href="/hutang/"><i class="fa fa-shopping-cart"></i> Bayar Hutang</a></li>
                    <li>
                        <a href="#"><i class="fa fa-print"></i> Laporan<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a href="/hutang/bayar/priode/"><i class="fa fa-calendar"></i> Priode</a></li>
                            <li><a href="/hutang/bayar/transaksi/"><i class="fa fa-database"></i> Transaksi</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } } ?>
            <?php
            if ($_SESSION['level'] == 1 || $_SESSION['level'] == 3) {
                if (isset($_SESSION['id_project'])) { ?>
            <li>
                <a href="#"><i class="fa fa-university"></i> <span class="nav-label">Inventory</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php
                    if ($_SESSION['level'] == 1) { ?>
                    <li><a href="/kavling/"><i class="fa fa-th-large"></i> Data Kavling</a></li>
                    <li><a href="/progress/"><i class="fa fa-sliders"></i> Data Progress</a></li>
                    <?php } ?>
                    <li><a href="/barang/"><i class="fa fa-server"></i> Data Barang</a></li>
                    <li><a href="/pengeluaran/"><i class="fa fa-shopping-cart"></i> Pengeluaran Barang</a></li>
                    <li>
                        <a href="#"><i class="fa fa-print"></i> Laporan<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a href="/pengeluaran/priode/"><i class="fa fa-calendar"></i> Priode</a></li>
                            <li><a href="/pengeluaran/kavling/"><i class="fa fa-th-large"></i> Kavling</a></li>
                            <li><a href="/pengeluaran/transaksi/"><i class="fa fa-database"></i> Transaksi</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } } ?>
            <?php
            if ($_SESSION['level'] == 1 || $_SESSION['level'] == 4) {
                if (isset($_SESSION['id_project'])) { ?>
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Payroll</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php
                    if ($_SESSION['level'] == 1) { ?>
                    <li><a href="/karyawan/"><i class="fa fa-users"></i> Data Karyawan</a></li>
                    <li><a href="/karyawan/bagian"><i class="fa fa-university"></i> Bagian</a></li>
                    <?php } ?>
                    <li><a href="/payroll/"><i class="fa fa-money"></i> Penggajian</a></li>
                    <li>
                        <a href="#"><i class="fa fa-print"></i> Laporan<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a href="/payroll/priode/"><i class="fa fa-calendar"></i> Priode</a></li>
                            <li><a href="/payroll/transaksi/"><i class="fa fa-database"></i> Transaksi</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } } ?>
            <li class="special_link">
                <a href="/logout/"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
            </li>
        </ul>

    </div>
</nav>
<?php } ?>
