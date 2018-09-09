<br/>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@yield('rn')</div>
            <div class="card-body">
                <div class="card-body">
                    @if($models->isEmpty())
                        <div class="alert alert-warning">
                            No Column Could Be Found In {{studly_case($table)}} Table
                        </div>
                    @else

                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <td>{{$column}}</td>
                                @endforeach

                                <td>edit</td>
                                <td>delete</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models->all() as $model)
                                <tr>
                                    @foreach($columns as $column)
                                        <td>{{$model->$column}}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{route(str_singular($table) . '.'.'edit', $model->id)}}" class="btn edit btn-danger" tag="{{$model->id}}">Edit</a>
                                    </td>
                                    <td class="delete-part">
                                        <a class="btn delete btn-danger" tag="{{$model->id}}">X</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$models->links()}}
                        <form id="form-delete" method="post">
                            @method('delete')
                            @csrf
                        </form>
                        <script type="text/javascript">
                            var count = 0;
                            document.onreadystatechange = function (s ,ss) {
                                if (count == 0){
                                    count++;
                                    return;
                                }
                                const a = document.querySelectorAll('.delete-part>a');
                                a.forEach(function (a , aa ,aaa) {
                                    a.onclick = function (mouse) {
                                        clickedOnDeleteLinks(a.getAttribute('tag'));
                                    };
                                });
                            };

                            function clickedOnDeleteLinks(value) {
                                const form = document.getElementById('form-delete');
                                form.action = '{{route($name.'.index')}}' + '/' + value;
                                form.submit();
                            }
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>