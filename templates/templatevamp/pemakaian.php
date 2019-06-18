<?php get_template('header') ?>

    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-list-alt"></i><h3>Daftar Pemakaian</h3>
                            </div>
                            <div class="widget-content">
                                <div class="controls pull-right">
                                    <div class="btn-group">
                                        <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari Pemakaian ...">
                                    </div>
                                </div>

                                <div class="controls pull-right">
                                    <div class="btn-group">
                                        <a class="btn btn-default" id="lbl-filter-pemakaian">Filter Pemakaian</a>
                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                        <ul class="dropdown-menu" id="btn-filter-pemakaian">
                                            <li><a href="pemakaian">Semua</a></li>
                                            <li><a href="pemakaian#ambil?status=selesai&amp;hal=1">Selesai</a></li>
                                            <li><a href="pemakaian#ambil?status=sedang_berjalan&amp;hal=1">Sedang Berjalan</a></li>
                                        </ul>
                                    </div>
                                </div>  <!-- /controls -->

                                <table id="tbl-pemakaian" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Pengemudi</th>
                                            <th class="text-center">Tujuan</th>
                                            <th class="text-center">Tgl Pemakaian</th>
                                            <th class="text-center">Nopol</th>
                                            <th class="text-center">Berangkat</th>
                                            <th class="text-center">Kembali</th>
                                            <th class="text-center">KM Awal</th>
                                            <th class="text-center">KM Akhir</th>
                                            <th class="text-center">Kode Pemakaian</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="controls pull-right">
                                    <ul id="pagination-pemakaian" class="pagination"></ul>
                                </div>
                            </div><!-- /widget-content -->
                        </div><!-- /widget -->
                    </div><!-- /span12 -->
                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /main-inner -->
    </div><!-- /main -->

    <!-- Popup Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah ...</h3>
        </div>

        <div class="modal-body">
            <form role="form" id="form-pemakaian" action="tambah">
                <fieldset class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="catatan">Catatan</label>
                        <div class="controls">
                            <input type="text" name="catatan" id="catatan" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="berangkat">Berangkat</label>
                        <div class="controls">
                            <input type="text" name="berangkat" id="berangkat" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="kembali">Kembali</label>
                        <div class="controls">
                            <input type="text" name="kembali" id="kembali" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="km_awal">Kilometer Awal</label>
                        <div class="controls">
                            <input type="text" name="km_awal" id="km_awal" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="km_akhir">Kilometer Akhir</label>
                        <div class="controls">
                            <input type="text" name="km_akhir" id="km_akhir" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="kode_pemakaian">Kode Pemakaian</label>
                        <div class="controls">
                            <input type="text" name="kode_pemakaian" id="kode_pemakaian" class="form-control input-block-level" value="" />
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="pemakaian_id" id="pemakaian_id"/>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-info" id="submit-pemakaian">Tambah</button>
        </div>
    </div>

<?php get_template('footer') ?>