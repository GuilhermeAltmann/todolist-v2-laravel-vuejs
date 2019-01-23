@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="todo">
        <div class="col-md-4" v-for="list in lists">
            <div class="card">
                <div class="card-header">@{{list.title}}</div>
                <div class="card-body">
                    <div class="row" v-for="item in list.itens">
                        <div class="col-md-9 col-sm-9">
                            <span>@{{item.description}}</span>
                        </div>   
                        <div class="col-md-3 col-sm-3 align-self-end">
                            <a href="javascript:void(0)">
                                <span class="oi oi-check" title="check"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-transfer" title="transfer"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-trash" title="remove"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
