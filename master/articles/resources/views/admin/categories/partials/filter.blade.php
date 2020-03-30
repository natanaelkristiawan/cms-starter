<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Filter</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-down"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content" style="display: none">
        <div class="row">
          <div class="col-lg-6">
          	<div class="form-group">
          		<label>Name</label> 
          		<input type="text" placeholder="Search Name Category" name="search[name]" class="form-control filter-field">
          	</div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>Status</label> 
              <select class="form-control filter-field" name="search[status]">
                <option value="all">All</option>
                <option value="1">Live</option>
                <option value="0">Draft</option>
              </select>
            </div>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group row">
          <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-primary btn-sm filter-btn" type="button">Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>