@extends('layouts.app')

@section('content')
<div class="container" id="todo">
    <div class="row">
        <div class="col-md-4 todolist-card" v-for="list in lists">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" v-model="list.title"></input>
                        </div>
                        <div class="col-md-2 col-sm-2 align-self-end">
                            <a href="javascript:void(0)">
                                <span class="oi oi-trash" title="remove"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" v-for="item in list.itens">
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" v-model="item.description"></input>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <a href="javascript:void(0)" v-on:click="add">
                                <span class="oi oi-plus icon-create" title="add"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
