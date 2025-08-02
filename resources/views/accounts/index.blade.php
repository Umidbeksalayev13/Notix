@include('layouts.header')
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><a href="https://t.me/notification_reminder1_bot?start={{ Auth::id() }} " target="_blank">Telegram</a></h4>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Chat id</th>
                            <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                           {{-- @dd($accounts) --}}
                            @foreach ( $accounts as $key=>$item)
                                <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->chat_id }}</td>
                                <td>
                                    <a class="btn btn-danger" href="">delete</a>
                                </td>
                                </tr>
                            @endforeach


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->



@include('layouts.footer')
