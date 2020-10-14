@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new user')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users

        <small>Add new user</small>
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li><a href="{{ route('backend.users.index')}}">Users</a></li>
        <li class="active">Add new</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::model($user, [
                'method' => 'POST',
                'route' => 'backend.users.store',
                'files' => TRUE,
                'id' => 'user-form'
            ])!!}
                @include('backend.users.form')
          {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    //$('ul.pagination').addClass('no-margin pagination-sm');

    $('#name').on('blur', function() {
            var theName = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theName.replace(/&/g, '-and-')
                                  .replace(/[^a-z0-9-]+/g, '-')
                                  .replace(/\-\-+/g, '-')
                                  .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });
  </script>
@endsection


