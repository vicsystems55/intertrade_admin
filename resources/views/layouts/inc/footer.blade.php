
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">New Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('api/create_requistion_request')}}" method="post">
          @csrf
          <div class="modal-body">

            <div class="form-group">
              <label for="">Department</label>
                <select name="department" id="" class="form-control">
                  <option value="sales">Sales</option>
                  <option value="utilities">Utilites</option>
                </select>
            </div>

            <div class="form-group">
              <label for=""></label>
              <input type="number" class="form-control" name="amount_requested" id="">
            </div>

            <div class="form-group">
              <label for=""></label>
              <textarea name="description" placeholder="For new compartments" class="form-control " id="" cols="30" rows="5"></textarea>
            </div>

          </div>
          <div class="modal-footer">
   
            <button type="submit" class="btn btn-primary shadow">Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div>
<footer class="page-footer">
    <p class="mb-0">Copyright © 2021. InterTrade.</p>
</footer>