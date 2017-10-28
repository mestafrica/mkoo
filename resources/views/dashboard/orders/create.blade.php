@extends('layouts.app')
@section('title', 'Meals for the week')
@section('content')
    <div class="container">
        <div class="row" style="color: #777777;">
            <div class="col-md-9 main-container">
                <div class="col-md-12 main-cont-order">
                    <div class="col-md-3 small-cont-order">
                        <ul class="nav nav-tabs nav-stacked" role="tablist">
                            <li role="presentation">
                                <a href="#monday" role="tab" data-toggle="tab" aria-controls="monday">Monday</a>
                            </li>
                            <li><a href="#tuesday">Tuesday</a></li>
                            <li><a href="">Wednesday</a></li>
                            <li><a href="">Thursday</a></li>
                            <li><a href="">Friday</a></li>
                            <li><a href="">Saturday</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9 big-cont-order tab-content">
                        <div id="monday" class="tab-pane order-card active" role="tabpanel">
                            <div class="lunch">
                                <h4>Lunch</h4>
                                <select name="">
                                    <option value="">Jollof rice and chicken</option>
                                    <option value="">Ugali and beef stew</option>
                                    <option value="">Wache</option>
                                </select>
                            </div>
                            <div class="Dinner">
                                <h4>Dinner</h4>
                                <select name="">
                                    <option value="">Jollof rice and chicken</option>
                                    <option value="">Ugali and beef stew</option>
                                    <option value="">Wache</option>
                                </select>
                            </div>
                            <div class="cancel-icon">X</div>
                        </div>

                        <div id="tuesday" class="tab-pane order-card" role="tabpanel">
                            <div class="lunch">
                                <h4>Lunch</h4>
                                <select name="">
                                    <option value="">Jollof rice and chicken</option>
                                    <option value="">Ugali and beef stew</option>
                                    <option value="">Wache</option>
                                </select>
                            </div>
                            <div class="Dinner">
                                <h4>Dinner</h4>
                                <select name="">
                                    <option value="">Jollof rice and chicken</option>
                                    <option value="">Ugali and beef stew</option>
                                    <option value="">Wache</option>
                                </select>
                            </div>
                            <div class="cancel-icon">X</div>
                        </div>

                        <div class="col-md-9 btn-parent">
                            <div class="btn btn-next"><a href="">Next meal</a></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection











