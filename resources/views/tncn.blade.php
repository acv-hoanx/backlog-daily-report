@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Thuế TNCN') }}</div>

                    <div class="card-body">
                        @if ($result)
                            sdsdsd
                        @endif
                        <form method="POST" action="{{ route('tncn.post') }}" aria-label="{{ __('Thuế TNCN') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="thunhapthang" class="col-md-6 col-form-label text-md-right">
                                    {{ __('Tổng thu nhập hàng tháng') }}
                                </label>

                                <div class="col-md-4">
                                    <input id="thunhapthang" type="number"
                                           class="form-control{{ $errors->has('thunhapthang') ? ' is-invalid' : '' }}"
                                           name="thunhapthang" value="{{ old('thunhapthang') }}" required autofocus>

                                    @if ($errors->has('thunhapthang'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('thunhapthang') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="nguoiphuthuoc" class="col-md-6 col-form-label text-md-right">
                                    {{ __('Số người phụ thuộc (3,6tr / 1 người)') }}
                                </label>

                                <div class="col-md-4">

                                    <input id="nguoiphuthuoc" type="number"
                                           class="form-control{{ $errors->has('nguoiphuthuoc') ? ' is-invalid' : '' }}"
                                           name="nguoiphuthuoc" value="{{ old('nguoiphuthuoc') ?: 0 }}" required
                                           autofocus>

                                    @if ($errors->has('nguoiphuthuoc'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nguoiphuthuoc') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Tính toán') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
