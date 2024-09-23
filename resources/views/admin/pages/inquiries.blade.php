@extends('admin.layouts.default')
@section('title', 'Inquiries')
@section('content')
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Contact Form Queries</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Email</th>
                                <th scope="col"> Phone No.</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Adction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $key => $inquirie)
                            <tr>
                                <th scope="row">{{ ++$key}}</th>
                                <td>{{$inquirie->name ?? ''}}</td>
                                <td>{{$inquirie->email ?? ''}}</td>
                                <td>{{$inquirie->phone ?? ''}}</td>
                                <td>
                                    @if($inquirie->message)
                                    @if(strlen(strip_tags($inquirie->message)) > 50)
                                    <span class="description-preview">{!! Str::limit(strip_tags($inquirie->message ?? ''), 80) !!}</span>
                                    <span class="description-full" style="display: none;">{!! $inquirie->message ?? '' !!}</span>
                                    <a class="text-danger read-more-btn" style="cursor: pointer;">Read More</a>
                                    @else
                                    <span class="description-full">{!! $inquirie->message ?? '' !!}</span>
                                    @endif
                                    @else
                                    <span class="text-center"></span>
                                    @endif

                                </td>
                                <td><button type="button" class="btn btn-success rounded-pill m-2">{{$inquirie->status ?? ''}}</button></td>
                                <td>
                                    <button type="button" class="btn btn-square  btn-outline-primary m-2">
                                        <i class="fa fa-envelope"></i>
                                    </button>
                                    <button type="button" class="delete btn btn-square btn-outline-danger m-2" data-id="{{$inquirie->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
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
<!-- Table End -->

<form id="delete_form" action="{{route('inquiries.destroy')}}" method="post">
    @csrf
    @method('DELETE')
    <input id="delete_form_id_input" type="hidden" value="" name="id">
</form>
<!-- End #main -->
@stop

@pushOnce('scripts')
<script>
    $(document).ready(function() {

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            $('#delete_form_id_input').val(id);
            $('#delete_form').submit();
        });

        $('.read-more-btn').click(function() {
            var $descriptionPreview = $(this).siblings('.description-preview');
            var $descriptionFull = $(this).siblings('.description-full');

            if ($descriptionPreview.is(':visible')) {
                $descriptionPreview.hide();
                $descriptionFull.show();
                $(this).addClass('read-less-btn').text('Read Less');
            } else {
                $descriptionPreview.show();
                $descriptionFull.hide();
                $(this).removeClass('read-less-btn').text('Read More');
            }
        });
    });
</script>
@endPushOnce