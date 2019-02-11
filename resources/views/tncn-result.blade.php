@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Thuế TNCN') }}</div>

                    <div class="card-body">
                        {{--<table class="table table-bordered align-content-center">
                            <thead>
                            <tr>
                                <th scope="col">Bậc thuế</th>
                                <th scope="col">Phần thu nhập tính thuế/tháng (triệu đồng)</th>
                                <th scope="col">Thuế suất (%)</th>
                                <th scope="col">Công thức tính số thuế phải nộp</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Đến 5</td>
                                <td>5%</td>
                                <td>Thu nhập tính thuế (TNTT) x 5%</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Trên 5 đến 10</td>
                                <td>10%</td>
                                <td>TNTT x 10% - 250.000 đ</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Trên 10 đến 18</td>
                                <td>15%</td>
                                <td>TNTT x 15% - 750.000 đ</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Trên 18 đến 32</td>
                                <td>20%</td>
                                <td>TNTT x 20% - 1.650.000 đ</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Trên 32 đến 52</td>
                                <td>25%</td>
                                <td>TNTT x 25% - 3.250.000 đ</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Trên 52 đến 80</td>
                                <td>30%</td>
                                <td>TNTT x 30% - 5.850.000 đ</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>Trên 80</td>
                                <td>35%</td>
                                <td>TNTT x 35% - 9.850.000 đ</td>
                            </tr>
                            </tbody>
                        </table>--}}

                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">
                                {{ __('Tổng thu nhập tháng') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format($result['thunhapthang'])}} VND
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Tổng các khoản hỗ trợ') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format(\App\Http\Controllers\THT)}} VND
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Tiền BHXH') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format(\App\Http\Controllers\BHXH)}} VND
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Phụ cấp bản thân') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format(\App\Http\Controllers\PCBT)}} VND
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Phụ cấp người phụ thuộc (3,6tr / 1 người)') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format($result['nguoiphuthuoc'])}} VND
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Thu nhập tính thuế') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format($result['thunhaptinhthue'])}} VND
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-md-right">
                                {{ __('Thuế TNCN phải đóng là:') }}
                            </label>

                            <div class="col-md-4">
                                <div class="form-control price">
                                    {{number_format($result['thueTNCN'])}} VND
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
