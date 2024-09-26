@extends('admin.layouts.default')
@section('title', 'Job View')
@section('content')

<style>
    body {
        padding: 20px 20px;
    }

    .results tr[visible='false'],
    .no-result {
        display: none;
    }

    .results tr[visible='true'] {
        display: table-row;
    }

    .counter {
        padding: 8px;
        color: #ccc;
    }
    .results{
        width: 95%;
        background: #fff;
    }
    .pull-right{
        width: 97%;
    }
</style>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="form-group pull-right mt-4">
            <input type="text" class="search form-control" placeholder="What you looking for?">
        </div>
        <span class="counter pull-right"></span>
        <table class="table table-hover table-bordered results mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="col-md-5 col-xs-5">Name / Surname</th>
                    <th class="col-md-4 col-xs-4">Job</th>
                    <th class="col-md-3 col-xs-3">City</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Vatanay Özbeyli</td>
                    <td>UI & UX</td>
                    <td>Istanbul</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Burak Özkan</td>
                    <td>Software Developer</td>
                    <td>Istanbul</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Egemen Özbeyli</td>
                    <td>Purchasing</td>
                    <td>Kocaeli</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Engin Kızıl</td>
                    <td>Sales</td>
                    <td>Bozuyük</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Blank End -->

<script>
    document.addEventListener("DOMContentLoaded", function() {//+
        document.querySelector(".search").addEventListener("keyup", function() {//+
            var searchTerm = document.querySelector(".search").value;//+
            var listItem = document.querySelectorAll('.results tbody tr');//+
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('");//+

            $.extend($.expr[':'], {
                'containsi': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });
            
//+
            Array.from(listItem).forEach(function(item) {//+
                if (!item.querySelector(":containsi('" + searchSplit + "')")) {//+
                    item.setAttribute('visible', 'false');//+
                } else {//+
                    item.setAttribute('visible', 'true');//+
                }//+
            });
        
//+
            var jobCount = document.querySelectorAll('.results tbody tr[visible="true"]').length;//+
            document.querySelector('.counter').textContent = jobCount + ' item';//+
            if (jobCount == '0') {
                
                document.querySelector('.no-result').style.display = 'block';//+
            } else {//-
                document.querySelector('.no-result').style.display = 'none';//+
            }
        });
    });

</script>

@stop

@pushOnce('scripts')
<script>

</script>
@endPushOnce