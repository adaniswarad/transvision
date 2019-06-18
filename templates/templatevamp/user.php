<?php get_template('header') ?>

	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<div class="widget">
							<div class="widget-header">
								<i class="icon-user"></i><h3>Daftar User</h3>
								<a class="btn btn-large btn-primary" href="<?=set_url('user#tambah');?>">Tambah User</a>
							</div>
							<div class="widget-content">
                                <div class="controls pull-right">
                                    <div class="btn-group">
                                        <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari User ...">
                                    </div>
                                </div>

								<table id="tbl-user" class="table table-striped table-bordered">
                                    <tbody>
                                    </tbody>
                                </table>

                                <div class="controls pull-right">
                                    <ul id="pagination-user" class="pagination"></ul>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah ...</h3>
        </div>

        <div class="modal-body">
            <form role="form" id="form-user" action="tambah">
                <fieldset class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input type="text" name="username" id="username" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" name="password" id="password" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input type="email" name="email" id="email" class="form-control input-block-level" value="" />
                        </div>
                        <label class="control-label" for="group">Group</label>
	                    <div class="controls">
	                        <?=form_dropdown_group();?>
	                    </div>
                    </div>
                </fieldset>
                <input type="hidden" name="user_id" id="user_id"/>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
            <button class="btn btn-info" id="submit-user">Tambah</button>
        </div>
    </div>
    
    <div id="loadingModal" class="modal hide">
        <div class="modal-header">
            <h3> Silahkan tunggu sebentar . . .</h3>
        </div>
    </div>

<?php get_template('footer') ?>