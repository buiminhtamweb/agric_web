<!-- Chỉnh sửa nông sản -->
<div class="tab-pane fade" id="tab_editAgri">
  <!-- Tìm kiếm nông sản -->
  <div class="input-group  " style="padding-left: 200px; padding-right: 200px;">
    <input type="text" class="form-control " id="input_timkiem" placeholder="Nhập tên nông sản">
    <button type="submit" class="btn btn-success ">Tìm kiếm</button>
  </div>
  <!-- View KQ tìm kiếm -->
  <div class="container">
      <div class="card card-nav-tabs" style="width: 100%;">
          <div class="text-center">
              <h2>Danh sách nông sản</h2>
          </div>
          <table class="table">
              <thead>
                  <tr>

                      <th class="text-center">ID</th>
                      <th>Tên NS</th>
                      <th>Thông tin</th>
                      <th class="text-right">Đơn giá</th>
                      <th class="text-center">Số lượng</th>
                      <th class="text-center">Hình</th>
                      <th class="text-right">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>

                      <td class="text-center">1</td>
                      <td>Tên nông sản</td>
                      <td>Thông tin nông sản</td>
                      <td class="text-right">50.000 VNĐ</td>
                      <td class="text-center">1</td>
                      <td class="text-center">...</td>
                      <td class="td-actions text-right">
                          <button type="button" rel="tooltip" class="btn btn-success">
                              <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" class="btn btn-danger">
                              <i class="material-icons">delete</i>
                          </button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>
