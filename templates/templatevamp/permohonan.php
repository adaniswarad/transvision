<?php get_template('header') ?>

    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-envelope"></i><h3>Daftar Permohonan</h3>
                            </div>
                            <div class="widget-content">
                                <table id="tbl-permohonan" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Pemohon</th>
                                            <th class="text-center">Tujuan</th>
                                            <th class="text-center">Keperluan</th>
                                            <th class="text-center">Jum Penumpang</th>
                                            <th class="text-center">Tgl Pengajuan</th>
                                            <th class="text-center">Tgl Pemakaian</th>
                                            <th class="text-center">Lama Pemakaian</th>
                                            <th class="text-center">Dasar Pemakaian</th>
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
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="controls pull-right">
                                    <ul id="pagination-permohonan" class="pagination"></ul>
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
            <form role="form" id="form-permohonan" action="tambah">
                <fieldset class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="pemohon">Pemohon</label>
                        <div class="controls">
                            <input type="text" name="pemohon" id="pemohon" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="tujuan">Tujuan</label>
                        <div class="controls">
                            <input type="text" name="tujuan" id="tujuan" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="keperluan">Keperluan</label>
                        <div class="controls">
                            <input type="text" name="keperluan" id="keperluan" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="jum_penumpang">Jumlah Penumpang</label>
                        <div class="controls">
                            <input type="text" name="jum_penumpang" id="jum_penumpang" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="tgl_pemakaian">Tanggal Pemakaian</label>
                        <div class="controls">
                            <input type="text" name="tgl_pemakaian" id="tgl_pemakaian" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="lama_pemakaian">Lama Pemakaian</label>
                        <div class="controls">
                            <input type="text" name="lama_pemakaian" id="lama_pemakaian" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="dasar_pemakaian">Dasar Pemakaian</label>
                        <div class="controls">
                            <input type="text" name="dasar_pemakaian" id="dasar_pemakaian" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="mobil">Mobil</label>
                        <div class="controls">
                            <select class="input-block-level" name="mobil_parent" id="mobil_parent">
                                <option value="">Pilih Mobil</option>
                            </select>
                        </div>
                        <label class="control-label" for="kode_pemakaian">Kode Pemakaian</label>
                        <div class="controls">
                            <input type="text" name="kode_pemakaian" id="kode_pemakaian" class="form-control input-block-level" value="" maxlength="4" />
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="permohonan_id" id="permohonan_id"/>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
            <button class="btn btn-info" id="submit-permohonan">OK</button>
        </div>
    </div>

<?php get_template('footer') ?>