<?php get_template('header') ?>

    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-truck"></i><h3>Daftar Mobil</h3>
                                <a class="btn btn-large btn-primary" href="<?=set_url('mobil#tambah');?>">Tambah Mobil</a>
                            </div>
                            <div class="widget-content">
                                <table id="tbl-mobil" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mobil</th>
                                            <th class="text-center">No Polisi</th>
                                            <th class="text-center">Tipe</th>
                                            <th class="text-center">Merk</th>
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
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="controls pull-right">
                                    <ul id="pagination-mobil" class="pagination"></ul>
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
            <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah Mobil</h3>
        </div>

        <div class="modal-body">
            <form role="form" id="form-mobil" action="tambah">
                <fieldset class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="mobil">Mobil</label>
                        <div class="controls">
                            <input type="text" name="mobil" id="mobil" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="nopol">No Polisi</label>
                        <div class="controls">
                            <input type="text" name="nopol" id="nopol" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="tipe">Tipe</label>
                        <div class="controls">
                            <input type="text" name="tipe" id="tipe" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="merk">Merk</label>
                        <div class="controls">
                            <input type="text" name="merk" id="merk" class="form-control input-block-level" value="" />
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="mobil_id" id="mobil_id"/>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
            <button class="btn btn-info" id="submit-mobil">OK</button>
        </div>
    </div>

<?php get_template('footer') ?>