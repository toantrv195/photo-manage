@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Photo
                        <small>Create</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @include('block.error')
                            <div class="form-group">
                                <label>Name Title</label>
                                <input class="form-control" name="txtTitle" placeholder="Please Enter Title " value="{{ old('txtTitle') }}" />
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="fImages" onchange="loadFile(event)">
                                <img id="output" style="width: 40%; height: 35%; margin-top: 20px;"/>
                                    <script>
                                        var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                      };
                                    </script>
                            </div>
                            <button type="submit" class="btn btn-default">Image Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
