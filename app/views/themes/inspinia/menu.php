<?php
use BITS\BITS;

?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <h6 class="hidden-md hidden-sm hidden-xs" style="display:inline;font-size:1.2em;line-height:3.6em;margin-left:10px"><?php $pesan = isset($_SESSION['id_project']) ? "Anda sedang mengelola project - ".BITS::getName("project", $_SESSION['id_project']) : 'Silahkan Pilih project !'; echo $pesan; ?></h6>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="/logout/">
                    <i class="fa fa-sign-out text-info"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
