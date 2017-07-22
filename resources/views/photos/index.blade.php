@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="page-header">Photo
            <small>List</small>
            <a href="{{ route('photo.create') }}" style="color: white;">
                <button type="button" class="delete_all btn btn-primary">
                    Create
                </button>
            </a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Time</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                <tr class="odd gradeX" align="center">
                @if ($loop->iteration)
                    <td>{{ $loop->iteration }}</td>
                @endif
                    <td>{{ $photo->title }}</td>
                    
                    <td>
                        <img width="250" height="210" src="{{ asset('upload/images/'.$photo->image) }}" alt="">
                    </td>
                    <td>
                        {{ \Carbon\Carbon::createfromTimeStamp(strtotime($photo->created_at))->diffForHumans() }}
                    </td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                        <a  href="{{ route('photo.delete', $photo->id) }}"
                        onclick="return confirm_delete('do you want to delete?')" > Delete</a>
                    </td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> 
                        <a href="{{ route('photo.edit', $photo->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!--phân trang -->
    <div class="col-sm-6">
        <div class="dataTables_paginate">
            <ul class="pagination">
            @if ($photos->currentPage() != 1)
                <li class="paginate_button previous">
                    <a href="{{ $photos->url($photos->currentPage() -1) }}">Prev</a>
                </li>
            @endif

            @for ($i = 1; $i<= $photos->lastPage(); $i++)
                <li class="paginate_button 
                    {{ ($photos->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $photos->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($photos->currentPage() != $photos->lastPage())
                <li class="paginate_button next">
                    <a href="{{ $photos->url($photos->currentPage() +1) }}">Next</a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>
@endsection
