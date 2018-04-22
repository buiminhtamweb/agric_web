<div class="tab-pane fade" id="tab_addAgri">
    <!-- Product insert form -->
    <form method="" action="">
        <div class="form-row">
            <div class="col">
                <div class="form-group has-success">
                    <label for="id_agri"></label>
                    <input type="text" class="form-control" id="id_agri" placeholder="Mã nông sản">
                </div>
            </div>
            <div class="col">
                <div class="form-group has-success">
                    <label for="id_kind"></label>
                    <input type="text" class="form-control" id="id_kind" placeholder="Mã loại">
                </div>
            </div>
        </div>

        <div class="form-group has-success">
            <label for="name_agri"></label>
            <input type="text" class="form-control" id="name_agri" placeholder="Tên nông sản">
        </div>

        <div class="form-group has-success">
                <label for="detail_agri"></label>
                <textarea class="form-control" id="detail_agri" rows="3" placeholder="Thông tin"></textarea>
        </div>

        <!-- File uploader -->
        <div class="form-group form-file-upload form-file-multiple has-success">
            <input type="file" multiple="" class="inputFileHidden">
            <div class="input-group">
                <input type="text" class="form-control inputFileVisible" placeholder="Upload file...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-success">
                        <i class="material-icons">attach_file</i>
                    </button>
                </span>
            </div>
        </div>

        <div class="form-group has-success">
                <label for="price_agri"></label>
                <input type="text" class="form-control" id="price_agri" placeholder="Đơn giá">
        </div>

        <div class="form-group has-success">
                <label for="amount_agri"></label>
                <input type="number" class="form-control" id="amount_agri" placeholder="Số lượng">
        </div>

    <br>
        <button type="submit" class="btn btn-success">THÊM</button>
        <button type="reset" class="btn btn-danger">RESET</button>
    </form>
</div>
