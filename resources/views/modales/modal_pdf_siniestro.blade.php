<div class="modal fade" id="miModalPdfSiniestro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            @if(!$errors->isEmpty())
            <div class="alert alert-danger">
              <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach()
              </ul>
            </div>
            @endif
            <div class="modal-body ">
              <form action="#" class="form-group" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="panel panel-success" id="modalopen"></div>
 
              </form>
            </div>
        </div>
    </div>
 </div>