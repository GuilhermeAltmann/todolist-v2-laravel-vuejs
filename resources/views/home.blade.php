@extends('layouts.app')

@section('content')
<div class="container" id="todo">
    <div class="row">
        <div class="col-md-4 todolist-card" v-for="(list, index) in lists">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control form-control-sm" v-model="list.title"></input>
                        </div>
                        <div class="col-md-3 col-sm-3 align-self-end">
                            <a href="javascript:void(0)" v-on:click="addItem(index)">
                                <span class="oi oi-plus" title="add"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-trash" title="remove"></span>
                            </a>     
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" v-for="(item, itemIndex) in list.itens">
                        <div class="col-md-8 col-sm-8">
                            <input class="form-control form-control-sm todolist-input input-sm" v-model="item.description"></input>
                        </div>   
                        <div class="col-md-4 col-sm-4 align-self-end">
                            <a href="javascript:void(0)">
                                <span class="oi oi-file todolist-icon" title="save"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-check todolist-icon" title="check"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-transfer todolist-icon" title="transfer" data-toggle="modal" data-target="#modalTransfer" v-on:click="changeModalTitle(index, itemIndex)"></span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="oi oi-trash todolist-icon" v-on:click="removeItem(index, itemIndex)" title="remove"></span>
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
                            <a href="javascript:void(0)" v-on:click="addCard">
                                <span class="oi oi-plus icon-create" title="add"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@{{item.description}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select</label>
                        <select class="form-control" v-model="card">
                            <option v-for="description, index) in cards" v-bind:value="index">
                                @{{ description }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Transfer</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
