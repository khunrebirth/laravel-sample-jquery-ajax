@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p><span id="productsTotal">Total {{ $products->total() }}</span> Page {{ $products->currentPage() }} Of {{ $products->lastPage() }}</p>

                    <div id="alert" class="alert alert-info"></div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>PRICE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger productDelete">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->render() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>

        (function ($) {

            $('#alert').hide();

            $('.productDelete').on('click', function (event) {

                event.preventDefault();

                if ( ! confirm('Are you sure?')) return false;

                var row = $(this).parents('tr');
                var form = $(this).parents('form');
                var url = form.attr('action');

                $('#alert').show();

                $.ajax({
                    url: url,
                    type: 'post',
                    data: form.serialize(),
                    success (result) {
                        row.fadeOut();
                        $('#productsTotal').html(result.total);
                        $('#alert').html(result.message);
                    },
                    error () {
                        $('#alert').html('Something wrong!');
                    }
                });

            })
        })(jQuery);

    </script>
@endsection
